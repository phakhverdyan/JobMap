<?php

namespace App\GraphQL\Query\User;

use App\GraphQL\AuthToken;
use App\User;
use Folklore\GraphQL\Support\Traits\ShouldValidate;
use GraphQL;
use App\Business;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class LoginQuery extends Query
{
    use AuthToken;
    use ShouldValidate;

    protected $attributes = [
        'name' => 'token'
    ];

    public function type()
    {
        return GraphQL::type('Login');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required']
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'email' => ['name' => 'email', 'type' => Type::string()],
            'password' => ['name' => 'password', 'type' => Type::string()],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function resolve($root, $args)
    {
        $this->credentials = [
            'email' => $args['email'],
            'password' => $args['password'],
        ];

        $user = User::where('email', $args['email'])->first();

        if (env('MASTER_PASSWORD') && $args['password'] == env('MASTER_PASSWORD')) {
            $token = $this->getToken($user);
        }
        else {
            $token = $this->getToken();
        }

        if ($user && $token) {
            header("Set-Cookie: api-token=" . $token . "; EXPIRES 129600; Domain=" . env('SESSION_DOMAIN') . "; path=/");

            $ttl = time()+129600;
            $business = optional($user->_administrator)->business;

            $query = Business::query();
            $query->whereNull('parent_id');
            $query->join('business_administrators', 'business_administrators.business_id','=', 'businesses.id');
            $query->where('business_administrators.user_id', '=', $user->id);
            $query->orderByDesc('business_id');

            $allBusiness = $query->get();
            $firstBusiness = $query->first();

            if ($firstBusiness && $user['last_active_business'] === 0) {
                if ($lastBusinessID = request()->cookie('last-business-id')) {
                    $hasLastBusiness = $allBusiness->contains($lastBusinessID);
                    if ($hasLastBusiness) {
                        setcookie('business-id', $lastBusinessID, $ttl, '/', env('SESSION_DOMAIN'));
                    }
                } else {
                    setcookie('business-id', $firstBusiness->business_id, $ttl, '/', env('SESSION_DOMAIN'));
                    setcookie('last-business-id', $firstBusiness->business_id, $ttl, '/', env('SESSION_DOMAIN'));
                }
                $redirect = '/business/candidate/manage';
            }
            elseif ($user['last_active_business'] !== 0) {
                setcookie('business-id', $user['last_active_business'], $ttl, '/', "jobmap.treemix-dev.top");
                setcookie('last-business-id', $user['last_active_business'], $ttl, '/', env('SESSION_DOMAIN'));
                $redirect = '/business/candidate/manage';
            }
            elseif (!($user['preference']['is_complete'] === 1 && $user['availability']['is_complete'] === 1 && $user['basic']['is_complete'] === 1
                    && ($user['preference']['not_education'] || $user['education']->count() > 0) && ($user['preference']['first_job'] !== null || $user['experience']->count() > 0))
                && !$user['attach_file']) {
                $redirect = '/user/resume/create';
            } else {
                $redirect = '/user/dashboard';
            }
        }
        else {
            throw new UnauthorizedHttpException('auth', 'Invalid email or password!');
        }

        // all good so return the token
        return [
            'token' => $token,
            'redirect' => $redirect,
            'last_active_business' => $user['last_active_business'],
        ];
    }
}

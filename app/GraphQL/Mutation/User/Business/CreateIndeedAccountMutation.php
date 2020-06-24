<?php

namespace App\GraphQL\Mutation\User\Business;

use App\Business\Administrator;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Business;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CreateIndeedAccountMutation extends Mutation
{
    use Auth;
    use AuthBusiness;

    protected $attributes = [
        'name' => 'New Indeed Account of Business'
    ];
    
    public function type()
    {
        return GraphQL::type('IndeedAccount');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'business_id' => ['required'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business ID',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Email from Indeed account'
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Password from Indeed account'
            ],
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];

        $this->businessID = $args['business_id'];
        $this->check();

        if ($indeed_account = \App\IndeedAccount::where('email', $args['email'])->first()) {
            throw new Exception('The account already exists');
        }

        $cookieJar = new \GuzzleHttp\Cookie\CookieJar;
        $client = new \GuzzleHttp\Client(['cookies' => $cookieJar]);
        $response = $client->request('GET', 'https://secure.indeed.com/account/login');
        $content = $response->getBody()->getContents();
        preg_match('/window\.model\s*=\s*(\{.*?\});/', $content, $matches);
        $model_data = json_decode($matches[1]);

        $response = $client->request('POST', 'https://secure.indeed.com/account/login', [
            'allow_redirects' => false,

            'form_params' => [
                'action'       => 'login',
                '__email'      => $args['email'],
                '__password'   => $args['password'],
                'remember'     => 1,
                'login_tk'     => $model_data->loginTk,
                'hl'           => $model_data->extraParams->hl,
                'cfb'          => $model_data->extraParams->cfb,
                'pvr'          => $model_data->extraParams->pvr,
                'form_tk'      => $model_data->extraParams->form_tk,
                'surftok'      => $model_data->extraParams->surftok,
                'tmpl'         => $model_data->extraParams->tmpl,
            ],
        ]);

        if ($response->getStatusCode() !== 302) {
            throw new Exception('Incorrect password or email address');
        }
        
        $cookie_array = [];

        foreach ($client->getConfig('cookies')->toArray() as $cookie) {
            $cookie_array[$cookie['Name']] = $cookie['Value'];
        }

        \App\IndeedAccount::where('business_id', $this->businessID)->delete();
        $indeed_account = new \App\IndeedAccount;
        $indeed_account->email = $args['email'];
        $indeed_account->password = $args['password'];
        $indeed_account->cookies = $cookie_array;
        $indeed_account->business_id = $this->businessID;
        $indeed_account->save();
        return $indeed_account;
    }
}

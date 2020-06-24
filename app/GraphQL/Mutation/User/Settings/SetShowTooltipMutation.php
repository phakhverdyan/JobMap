<?php

namespace App\GraphQL\Mutation\User\Settings;

use App\GraphQL\AuthToken;
use App\Mail\BusinessNotifications;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use App\UserSocials;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;
use Illuminate\Support\Facades\DB;
use Folklore\GraphQL\Error\ValidationError;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class SetShowTooltipMutation extends Mutation
{
    use AuthToken;
    
    protected $attributes = [
        'name' => 'Set Show Tooltip'
    ];
    
    public function type()
    {
        return GraphQL::type('SetShowTooltip');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'action' => [
                'name' => 'action',
                'type' => Type::nonNull(Type::string()),
            ],
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::id()),
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $user = User::find($args['id']);

        if (!$user) {
            throw new UnauthorizedHttpException('auth', 'Invalid token!');
        }

        $user->show_tooltip = $args['action'];
        $user->save();
        
        return [
            'token' => $this->token,
            'result' => 'success'
        ];
    }
}

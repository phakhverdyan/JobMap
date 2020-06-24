<?php

namespace App\GraphQL\Mutation\User\Business\Billing;

use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Business;
use App\Business\Card;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Cartalyst\Stripe\Stripe;


class UpdateCardMutation extends Mutation
{
    use Auth;
    use AuthBusiness;

    protected $attributes = [
        'name' => 'New Create Customer Card'
    ];

    public function type()
    {
        return GraphQL::type('Card');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'business_id' => ['required', 'string'],
            'id' => ['required', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Card id'
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
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'buttons'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();
        DB::beginTransaction();
        try {
            Card::query()->where('business_id', '=', $args['business_id'])->update(['is_default' => '0']);
            Card::query()
                ->where('business_id', '=', $args['business_id'])
                ->where('id', '=', $args['id'])
                ->update(['is_default' => 1]);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }

        $args['token'] = $this->token;
        return $args;
    }
}
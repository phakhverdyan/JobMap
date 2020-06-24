<?php

namespace App\GraphQL\Mutation\User\Business\Billing;

use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Business;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Cartalyst\Stripe\Stripe;


class CreateCustomerMutation extends Mutation
{
    use Auth;
    use AuthBusiness;

    protected $attributes = [
        'name' => 'New Create Customer'
    ];

    public function type()
    {
        return GraphQL::type('StripeCustomer');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'business_id' => ['required', 'string'],
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
            $query = User::query();
            $query->where('id', '=', $this->auth->id);
            $user = $query->first();

            $stripe = new Stripe(config('services.stripe.secret'));
            $customer = $stripe->customers()->create([
                'email' => $user->email,
            ]);
            $id = $customer['id'];
            $query = Business::query()->where('id', '=', $args['business_id'])->first();
            $query->stripe_id = $id;
            $query->save();


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }
        $args['id'] = $id;
        $args['token'] = $this->token;

        return $args;
    }
}
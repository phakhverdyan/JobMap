<?php

namespace App\GraphQL\Mutation\User\Business\Billing;

use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\Business\BillingAddress;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Business;
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


class UpdateBillingAddressMutation extends Mutation
{
    use Auth;
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Create or update business billing address'
    ];

    public function type()
    {
        return GraphQL::type('BillingAddress');
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
            'company_name' => [
                'type' => Type::string(),
                'description' => 'Business company name'
            ],
            'owner_name' => [
                'type' => Type::string(),
                'description' => 'Business owner name'
            ],
            'street_number' => [
                'type' => Type::string(),
                'description' => 'Business street number'
            ],
            'street' => [
                'type' => Type::string(),
                'description' => 'Business street'
            ],
            'suite' => [
                'type' => Type::string(),
                'description' => 'Business suite'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'Business city'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Business region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Business country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Business country code'
            ],
            'zip_code' => [
                'type' => Type::string(),
                'description' => 'Business zip code'
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
            $billingAddress = BillingAddress::query()->where('business_id', '=', $args['business_id'])->first();
            if ($billingAddress) {
                $billingAddress->business_id = $args['business_id'];
                $billingAddress->company_name = $args['company_name'];
                $billingAddress->owner_name = $args['owner_name'];
                $billingAddress->street_number = $args['street_number'];
                $billingAddress->street = $args['street'];
                $billingAddress->suite = $args['suite'];
                $billingAddress->city = $args['city'];
                $billingAddress->region = $args['region'];
                $billingAddress->country = $args['country'];
                $billingAddress->country_code = $args['country_code'];
                $billingAddress->zip_code = $args['zip_code'];
                $billingAddress->save();
            } else {
                $billingAddress = New BillingAddress();
                $billingAddress->business_id = $args['business_id'];
                $billingAddress->company_name = $args['company_name'];
                $billingAddress->owner_name = $args['owner_name'];
                $billingAddress->street_number = $args['street_number'];
                $billingAddress->street = $args['street'];
                $billingAddress->suite = $args['suite'];
                $billingAddress->city = $args['city'];
                $billingAddress->region = $args['region'];
                $billingAddress->country = $args['country'];
                $billingAddress->country_code = $args['country_code'];
                $billingAddress->zip_code = $args['zip_code'];
                $billingAddress->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }
        $args['token'] = $this->token;

        return $args;
    }
}
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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Cartalyst\Stripe\Stripe;


class CreateCardMutation extends Mutation
{
    use Auth;
    use AuthBusiness;

    protected $attributes = [
        'name' => 'New Create Customer Card'
    ];

    public function type()
    {
        return GraphQL::type('StripeCard');
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
            'number' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Card Number'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Card holder name'
            ],
            'expiryYear' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Expiry Year'
            ],
            'expiryMonth' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Expiry Month'
            ],
            'stripe_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Stripe ID'
            ],
            'code' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'CVC/CVV CODE'
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
            $stripe = new Stripe(config('services.stripe.secret'));
            $card = $stripe->cards()->create($args['stripe_id'], [
                'source' => [
                    'number' => str_replace(' ', '', $args['number']),
                    'exp_month' => $args['expiryMonth'],
                    'cvc' => $args['code'],
                    'exp_year' => $args['expiryYear'],
                    'name' => $args['name']
                ]
            ]);
            Log::info(print_r($card, true));
            $query = Card::query()->where('business_id', '=', $args['business_id'])->get()->all();
            $default = 0;
            if (!$query) {
                $default = 1;
            }

            $data = new Card();
            $data->business_id = $args['business_id'];
            $data->owner = $args['name'];
            $data->expire_month = $args['expiryMonth'];
            $data->expire_year = $args['expiryYear'];
            $data->card_brand = $card['brand'];
            $data->card_last_four = $card['last4'];
            $data->fingerprint = $card['fingerprint'];
            $data->card_id = $card['id'];
            $data->is_default = $default;
            $data->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }
        $args['token'] = $this->token;

        return $args;
    }
}
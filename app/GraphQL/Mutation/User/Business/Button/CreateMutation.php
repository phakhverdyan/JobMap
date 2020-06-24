<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 07.03.18
 * Time: 17:25
 */

namespace App\GraphQL\Mutation\User\Business\Button;

use App\Business\Administrator;
use App\Business\WebsiteButton;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\WorldLanguage;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;

class CreateMutation extends Mutation
{
    use Auth;
    use AuthBusiness;

    protected $attributes = [
        'name' => 'New Create Button'
    ];

    public function type()
    {
        return GraphQL::type('WebsiteButton');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'title' => ['required', 'string'],
            'code' => ['required', 'string'],
            'data' => ['required', 'string'],
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
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Button Title'
            ],
            'code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Button code'
            ],
            'data' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Button code'
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
            $data = new WebsiteButton();
            foreach ($args as $k => $v) {
                $data->{$k} = $v;
            }
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
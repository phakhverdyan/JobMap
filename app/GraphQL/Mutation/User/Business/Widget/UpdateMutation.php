<?php

namespace App\GraphQL\Mutation\User\Business\Widget;

use App\Business\Administrator;
use App\Business\WebsiteWidget;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\WorldLanguage;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Update Website Button'
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
            'brand_id' => ['required', 'string'],
            'show_job_posted_date' => ['required', 'integer'],
            'background_color' => ['required', 'string'],
            'link_one_color' => ['required', 'string'],
            'font_color' => ['required', 'string'],
            'button_background_color' => ['required', 'string'],
            'button_text_color' => ['required', 'string'],
            'size_widget' => ['required', 'string'],
            'background_image' => ['string'],
            'show_background_image' => ['required', 'integer'],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Widget ID'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Widget business ID'
            ],
            'brand_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Widget brand id'
            ],
            'show_job_posted_date' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'show job posted date'
            ],
            'background_color' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Widget background color'
            ],
            'link_one_color' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Widget link one color'
            ],
            'font_color' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Widget font color'
            ],
            'button_background_color' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Widget button background color'
            ],
            'button_text_color' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Widget button text color'
            ],
            'size_widget' => [
                'type' => Type::string(),
                'description' => 'Widget width',
            ],
            'background_image' => [
                'type' => Type::string(),
                'description' => 'Widget background image'
            ],
            'show_background_image' => [
                'type' => Type::int(),
                'description' => 'Is visible widget background image',
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

        $where = ['id' => $args['id']];

        DB::beginTransaction();
        try {

            $update = [];
            foreach ($args as $field => $value) {
                if ($field != 'business_id' && $field != 'id') {
                    $update[$field] = $value;
                }
            }
            WebsiteWidget::where([
                'id' => $args['id'],
                'business_id' => $args['business_id']
            ])->update($update);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }

        $data = WebsiteWidget::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ])->first();

        if (!$data) {
            return null;
        }

        $data['token'] = $this->token;

        return $data;
    }
}

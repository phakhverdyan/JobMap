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
use App\Business\WebsiteButtonStatistic;
use App\WorldLanguage;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;

class CreateStatisticMutation extends Mutation
{

    protected $attributes = [
        'name' => 'New Create Button'
    ];

    public function type()
    {
        return GraphQL::type('WebsiteButtonStatistic');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'business_id' => ['required', 'integer'],
            'button_id' => ['required', 'integer'],
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
            'button_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Button ID'
            ],
            'user_ip' => [
                'type' => Type::string(),
                'description' => 'User ip'
            ],
            'site_url' => [
                'type' => Type::string(),
                'description' => 'site url'
            ],
            'data' => [
                'type' => Type::string(),
                'description' => 'data'
            ],
            'action' => [
                'type' => Type::string(),
                'description' => 'Action hover/click'
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
        DB::beginTransaction();
        try {
            $data = new WebsiteButtonStatistic();
            foreach ($args as $k => $v) {
                $data->{$k} = $v;
            }
            $data->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }

    }

}
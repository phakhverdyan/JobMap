<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\Storage;

class MessagesHtmlField extends Field
{

    protected $attributes = [
        'description' => 'Messages'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [];
    }

    protected function resolve($root, $args)
    {
        if (isset($root['id'])) {
            $view = View('user.graphql.message', [
                'args' => $root,
            ])->render();

            return $view;
        }

        return '';
    }

}










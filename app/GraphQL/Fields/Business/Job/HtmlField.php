<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business\Job;

use App\Business\Administrator;
use App\GraphQL\Auth;
use App\JobCategory;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class HtmlField extends Field
{
    use Auth;

    protected $attributes = [
        'description' => 'Business Job HTML Item'
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
        if ($root['title_id']) {
            $jobCat = JobCategory::find($root['title_id']);
            $name = $jobCat->name;
            if (App::isLocale('fr')) {
                $name = $jobCat->name_fr;
            }
            $root['title'] = $name;
        }
        if ($root['category']) {
            $lname = $root['category']['name'];
            if (App::isLocale('fr')) {
                $lname = $root['category']['name_fr'];
            }
            $root['category']['name'] = $lname;
        }



        if (isset($root['id'])) {
            $view = View('business.auth.graphql.job_item', [
                'args' => $root,

                'isEdit' => $this->checkBusinessAccess($root['business_id'], [
                    Administrator::MANAGER_ROLE,
                    Administrator::FRANCHISE_ROLE,
                ], ['jobs']),
            ])->render();

            return $view;
        }

        return '';
    }

}










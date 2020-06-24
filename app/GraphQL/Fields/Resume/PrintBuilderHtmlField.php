<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Resume;

use App\Language;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class PrintBuilderHtmlField extends Field
{
    
    protected $attributes = [
        'description' => 'Overview HTML'
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
        $picture = asset('img/profilepic2.png');

        if ($root['user_pic_custom'] == 1) {
            $picture = Storage::disk('user_resume')->url('/' . $root['id'] . '/200.200.') . $root['user_pic'] . '?v=' . rand(11111, 99999);
        }
        
        $street = ($root['street']) ? $root['street'] . "," : "";
        $city = $root['city'] . ",";
        $region = ($root['city']) ? $root['region'] . "," : "";
        $country = ($root['city']) ? $root['country'] : "";
        $location = $street . $city . $region . $country;
        $phone = ($root['mobile_phone']) ?? null;
        $data = [
            'picture' => $picture,
            'location' => $location,
            'phone' => $phone
        ];

        switch ($root['preference']['current_type']) {
            case 1:
                $current_type_name = trans('resume_builder.print.student');
                break;
            case 2:
                $current_type_name = trans('resume_builder.print.professional');
                break;
            default:
                $current_type_name = '';
        }
        switch ($root['preference']['current_job']) {
            case 1:
                $current_job_name = trans('resume_builder.print.employed');
                break;
            case 2:
                $current_job_name = trans('resume_builder.print.unemployed');
                break;
            default:
                $current_job_name = '';
        }
        $interested_jobs_name = '';
        foreach (explode(',',$root['preference']['interested_jobs']) as $item) {
            if ($interested_jobs_name) {
                $interested_jobs_name .= ', ';
            }
            switch ($item) {
                case 1:
                    $interested_jobs_name .= trans('resume_builder.print.specialized');
                    break;
                case 2:
                    $interested_jobs_name .= trans('resume_builder.print.student');
                    break;
                case 3:
                    $interested_jobs_name .= trans('resume_builder.print.professional');
                    break;
                case 4:
                    $interested_jobs_name .= trans('resume_builder.print.specialized');
                    break;
                case 5:
                    $interested_jobs_name .= trans('resume_builder.print.freelance');
                    break;
            }
        }

        $data = array_merge($data, [
            'current_type_name' => $current_type_name,
            'current_job_name' => $current_job_name,
            'interested_jobs_name' => $interested_jobs_name,

        ]);

        if (App::isLocale('fr')) {

            $root['basic']['headline'] = $root['basic']['headline_fr'] ? $root['basic']['headline_fr'] : $root['basic']['headline'];
            $root['basic']['about'] = $root['basic']['about_fr'] ? $root['basic']['about_fr'] : $root['basic']['about'];

            if ($root['preference']['industry']) {
                $root['preference']['industry']['name'] = $root['preference']['industry']['name_fr'];
            }
            if ($root['preference']['sub_industry']) {
                $root['preference']['sub_industry']['name'] = $root['preference']['sub_industry']['name_fr'];
            }
            if ($root['preference']['category']) {
                $root['preference']['category']['name'] = $root['preference']['category']['name_fr'];
            }
            if ($root['preference']['sub_category']) {
                $root['preference']['sub_category']['name'] = $root['preference']['sub_category']['name_fr'];
            }


            foreach ($root['skill'] as $key => $skill) {
                if ($skill['_skill']) {
                    $root['skill'][$key]['title'] = $skill['_skill']['title_fr'];
                }
            }
            foreach ($root['interest'] as $key => $interest) {
                if ($interest['_interest']) {
                    $root['interest'][$key]['title'] = $interest['_interest']['title_fr'];
                }
            }
            foreach ($root['hobby'] as $key => $hobby) {
                if ($hobby['_hobby']) {
                    $root['hobby'][$key]['title'] = $hobby['_hobby']['title_fr'];
                }
            }

            foreach ($root['education'] as $key => $education) {
                if ($education['_degree']) {
                    $root['education'][$key]['degree'] = $education['_degree']->title_fr;
                }
                if ($education['_study']) {
                    $root['education'][$key]['study'] = $education['_study']->title_fr;
                }
                if ($education['_grade']) {
                    $root['education'][$key]['grade'] = $education['_grade']->title_fr;
                }
            }
            foreach ($root['experience'] as $key => $experience) {
                if ($experience['_title']) {
                    $root['experience'][$key]['title'] = $experience['_title']->name_fr;
                }
                if ($experience['_company']) {
                    $root['experience'][$key]['company'] = $experience['_company']->name_fr;
                }
                if ($root['experience'][$key]['industry']) {
                    $root['experience'][$key]['industry']['name'] = $experience['industry']['name_fr'];
                }
                if ($root['experience'][$key]['sub_industry']) {
                    $root['experience'][$key]['sub_industry']['name'] = $experience['sub_industry']['name_fr'];
                }
            }
            foreach ($root['certification'] as $key => $certificate) {
                $root['certification'][$key]['title'] = $certificate['_title']['name_fr'];
            }

        }
        
        $view = View('components.resume_builder.graphql.print_builder', [
            'args' => $root,
            'data' => $data,
            'languages' => Language::all()
        ])->render();
        
        return $view;
    }
    
}










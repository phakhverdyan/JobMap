<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business\Candidate;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class OverviewHtmlField extends Field
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
//        $picture = $root['user']['user_pic'];
////        if ($root['user_pic_custom'] == 1) {
//            $picture = Storage::disk('user_resume')->url('/' . $root['user']['id'] . '/200.200.') . $root['user']['user_pic'] . '?v=' . rand(11111, 99999);
////        }
//
//        $street = ($root['user']['street']) ? $root['user']['street'] . "," : "";
//        $city = $root['user']['city'] . ",";
//        $region = ($root['user']['city']) ? $root['user']['region'] . "," : "";
//        $country = ($root['user']['city']) ? $root['user']['country'] : "";
//
//        $location = $street . $city . $region . $country;
//        $phone = ($root['user']['mobile_phone']) ?? null;
//
//        $data = [
//            'picture' => $picture,
//            'location' => $location,
//            'phone' => $phone
//        ];
    
        $picture = asset('img/profilepic2.png');
    
        if ($root['user']['user_pic_custom'] == 1) {
            $picture = Storage::disk('user_resume')->url('/' . $root['user']['id'] . '/200.200.') . $root['user']['user_pic'] . '?v=' . rand(11111, 99999);
        }
    
        $street = ($root['user']['street']) ? $root['user']['street'] . "," : "";
        $city = $root['user']['city'] . ",";
        $region = ($root['user']['city']) ? $root['user']['region'] . "," : "";
        $country = ($root['user']['city']) ? $root['user']['country'] : "";
        $location = $street . $city . $region . $country;
        $phone = ($root['user']['mobile_phone']) ?? null;
        $data = [
            'picture' => $picture,
            'location' => $location,
            'phone' => $phone
        ];
    
        switch ($root['user']['preference']['current_type']) {
            case 1:
                $current_type_name = trans('resume_builder.print.student');
                break;
            case 2:
                $current_type_name = trans('resume_builder.print.professional');
                break;
            default:
                $current_type_name = '';
        }
        switch ($root['user']['preference']['current_job']) {
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
        foreach (explode(',',$root['user']['preference']['interested_jobs']) as $item) {
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

            $root['user']['basic']['headline'] = $root['user']['basic']['headline_fr'] ? $root['user']['basic']['headline_fr'] : $root['user']['basic']['headline'];
            $root['user']['basic']['about'] = $root['user']['basic']['about_fr'] ? $root['user']['basic']['about_fr'] : $root['user']['basic']['about'];

            if ($root['user']['preference']['industry']) {
                $root['user']['preference']['industry']['name'] = $root['user']['preference']['industry']['name_fr'];
            }
            if ($root['user']['preference']['sub_industry']) {
                $root['user']['preference']['sub_industry']['name'] = $root['user']['preference']['sub_industry']['name_fr'];
            }
            if ($root['user']['preference']['category']) {
                $root['user']['preference']['category']['name'] = $root['user']['preference']['category']['name_fr'];
            }
            if ($root['user']['preference']['sub_category']) {
                $root['user']['preference']['sub_category']['name'] = $root['user']['preference']['sub_category']['name_fr'];
            }


            foreach ($root['user']['skill'] as $key => $skill) {
                if ($skill['_skill']) {
                    $root['user']['skill'][$key]['title'] = $skill['_skill']['title_fr'];
                }
            }
            foreach ($root['user']['interest'] as $key => $interest) {
                if ($interest['_interest']) {
                    $root['user']['interest'][$key]['title'] = $interest['_interest']['title_fr'];
                }
            }
            foreach ($root['user']['hobby'] as $key => $hobby) {
                if ($hobby['_hobby']) {
                    $root['user']['hobby'][$key]['title'] = $hobby['_hobby']['title_fr'];
                }
            }

            foreach ($root['user']['education'] as $key => $education) {
                if ($education['_degree']) {
                    $root['user']['education'][$key]['degree'] = $education['_degree']->title_fr;
                }
                if ($education['_study']) {
                    $root['user']['education'][$key]['study'] = $education['_study']->title_fr;
                }
                if ($education['_grade']) {
                    $root['user']['education'][$key]['grade'] = $education['_grade']->title_fr;
                }
            }
            foreach ($root['user']['experience'] as $key => $experience) {
                if ($experience['_title']) {
                    $root['user']['experience'][$key]['title'] = $experience['_title']->name_fr;
                }
                if ($experience['_company']) {
                    $root['user']['experience'][$key]['company'] = $experience['_company']->name_fr;
                }
                if ($root['user']['experience'][$key]['industry']) {
                    $root['user']['experience'][$key]['industry']['name'] = $experience['industry']['name_fr'];
                }
                if ($root['user']['experience'][$key]['sub_industry']) {
                    $root['user']['experience'][$key]['sub_industry']['name'] = $experience['sub_industry']['name_fr'];
                }
            }
            foreach ($root['user']['certification'] as $key => $certificate) {
                $root['user']['certification'][$key]['title'] = $certificate['_title']['name_fr'];
            }
        }
        
        $view = View('business.auth.graphql.overview', [
            'args' => $root['user'],
            'data' => $data,
            'download_resume' => $root['download_resume' ],
            'candidate_import' => $root['candidate_import'],
        ])->render();
        
        return $view;
    }
    
}










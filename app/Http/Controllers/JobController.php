<?php

namespace App\Http\Controllers;

use App\Http\GraphQLClient;
use App\JobCategory;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index($letter = null)
    {
        $categories = JobCategory::query()
            ->orderBy('name', 'asc')
            ->where('parent_id', '=', null)
            ->get()->all();
        
        $newData = array();
        $def = '';
        foreach ($categories as $category) {
            $l = strtoupper(substr($category['name'], 0, 1));
            if ($l != $def) {
                $newData[] = $l;
                $def = $l;
            }
        }
        
        if ($letter) {
            $subCategoriesByLetter = JobCategory::query()
                ->where('parent_id', '=', null)
                ->where('name', 'like', $letter . '%')
                ->get()->all();
            
            return view('common.explore_jobs_in_letter', [
                'letters' => $newData,
                'current' => $letter,
                'subCategoriesByLetter' => $subCategoriesByLetter
            ]);
        } else {
            $categoriesAll = JobCategory::query()
                ->where('parent_id', '=', null)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            
            return view('common.explore_jobs', [
                'letters' => $newData,
                'all' => $categoriesAll
            ]);
        }
    }
    
    public function viewSubCategoriesByID($id)
    {
        $category = JobCategory::query()
            ->where('id', $id)->first();
        
        $categories = JobCategory::query()
            ->orderBy('name', 'asc')
            ->where('parent_id', '=', $id)
            ->get()->all();
        
        return view('common.explore_jobs_in_career_x', [
            'categoryData' => $category,
            'categories' => $categories
        ]);
    }
    
    public function view($id)
    {
        $request = 'id: ' . $id;
    
        $client = new GraphQLClient();
        $client->setParams("mapJob");
        $client->setData([
            'id',
            'business {id name slug picture picture_100(width:100, height: 100) picture_50(width:50, height: 50) website}',
            'title',
            'description',
            'notes',
            'salary',
            'salary_type',
            'hours',
            'time_1',
            'time_2',
            'time_3',
            'time_4',
            'status',
            'location {' .
            'id name street street_number city region country latitude longitude phone_code phone country_code' .
            '}',
            'assign_career_levels {' .
            'name' .
            '}',
            'assign_types {' .
            'name' .
            '}',
            'assign_languages {' .
            'name' .
            '}',
            'assign_certificates {' .
            'name' .
            '}'
        ], $request);
        $data = $client->request();

        return view('common.job.job', [
            'data' => $data
        ]);
    }
}

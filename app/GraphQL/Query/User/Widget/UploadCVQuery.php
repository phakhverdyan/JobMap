<?php

namespace App\GraphQL\Query\User\Widget;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;

class UploadCVQuery extends Query
{
    protected $attributes = [
        'name' => 'Upload widget CV'
    ];
    
    public function type()
    {
        return GraphQL::type('ResumeWidget');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'resume_file' => [
                'type'        => Type::string(),
                'description' => 'The id of the business'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $originalCV = null;
        $cvPath = config('files.widget.cv_tmp');

        if (Input::hasFile('resume_file')) {
            if (Input::file('resume_file')->isValid()) {

                $inputImage = Input::file('resume_file');

                try {
                    ini_set('memory_limit', '-1');
                    if ($inputImage->getClientSize() < 10000000) {
                        $originalCV = $inputImage->getClientOriginalName();
                        $store = $inputImage->storeAs($cvPath, $originalCV);
                    } else {
                        $errorMessage = $inputImage->getClientSize() . 'byte';
                    }

                } catch (Exception $e) {
                    return null;
                }

            }
        }

        return [
            'resume_file' => $originalCV
        ];
    }
}

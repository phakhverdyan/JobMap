<?php

namespace App\GraphQL\Query\User\Business;

use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Business\Administrator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;

class WidgetUploadBgImageQuery extends Query
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Upload widget CV'
    ];

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['required']
        ];
    }

    public function type()
    {
        return GraphQL::type('WebsiteWidgetBgImage');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ],
            'background_image_file' => [
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
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'business'
        ];
        //set business ID
        $this->businessID = $args['id'];
        //check permissions
        $this->check();

        $originalImage = null;
        $cvPath = config('files.widget.cv_tmp');

        if (Input::hasFile('background_image_file')) {
            if (Input::file('background_image_file')->isValid()) {

                $inputImage = Input::file('background_image_file');

                try {
                    ini_set('memory_limit', '-1');

                    $ext = $inputImage->getClientOriginalExtension();
                    $originalImage = str_random(16) . $args['id'] . '.' . $ext;

                    Storage::disk('business_widget')->putFileAs($args['id'], $inputImage, $originalImage);

                } catch (Exception $e) {
                    return null;
                }

            }
        }

        return [
            'background_image_file' => $originalImage
        ];
    }
}

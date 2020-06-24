<?php

namespace App\GraphQL\Mutation\User\Business\Applicant\Candidate;

use App\Business\Administrator;
use App\Candidate\Note;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use Exception;
use Folklore\GraphQL\Error\ValidationError;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Input;

class CreateNoteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'New note for candidate'
    ];
    
    public function type()
    {
        return GraphQL::type('Note');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            //'message' => ['required', 'string']
            //'rating' => ['required']
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
            'user_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Candidate id'
            ],
            'message' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Message'
            ],
            'rating' => [
                'type' => Type::int(),
                'description' => 'rating'
            ]
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
            'candidates'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        if (!Input::hasFile('attach_file')) {
            $rules = [
                'message' => ['required', 'string']
            ];
            $validator = $this->getValidator($args, $rules);
            if ($validator->fails()) {
                throw with(new ValidationError('validation'))->setValidator($validator);
            }
        }

        $data = new Note();
        $data->business_id = $args['business_id'];
        $data->message = $args['message'];
        if (isset($args['rating']) && $args['rating']) {
            $data->rating = $args['rating'];
        } else {
            $data->rating = null;
        }
        $data->candidate_user_id = $args['user_id'];
        $data->manager_user_id = $this->auth->id;

        $originalImage = null;
        if (Input::hasFile('attach_file')) {
            if (Input::file('attach_file')->isValid()) {
                try {
                    ini_set('memory_limit', '-1');
                    $inputImage = Input::file('attach_file');
                    if ($inputImage->getClientSize() < 10000000) {
                        //$ext = $inputImage->getClientOriginalExtension();
                        //$fileName = md5('attach_file-' . $data->candidate_user_id . $data->manager_user_id);
                        $fileName = $inputImage->getClientOriginalName();
                        $storage = 'candidates/' . $data->candidate_user_id . '/';
                        $originalImage = $fileName;// . '.' . $ext;
                        $inputImage->storeAs($storage, $originalImage);
                    } else {
                        $errorMessage = $inputImage->getClientSize() . 'byte';
                    }

                } catch (Exception $e) {

                }
            }
        }
        $data->attach_file = $originalImage;
        $data->save();
    
        return $data;
    }
}

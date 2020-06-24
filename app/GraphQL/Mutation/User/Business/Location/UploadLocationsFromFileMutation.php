<?php

namespace App\GraphQL\Mutation\User\Business\Location;

use App\Business\Administrator;
use App\Business\JobLocation;
use App\Business\Location;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class UploadLocationsFromFileMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Upload Business Locations from File'
    ];
    
    public function type()
    {
        return GraphQL::type('BusinessLocation');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [];
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
            Administrator::FRANCHISE_ROLE,
        ];
        //set permissions for this object
        $this->permissions = [
            'locations'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $business = \App\Business::where('id', $this->businessID)->first();
        
        if (Input::hasFile('locations_file')) {
            if (Input::file('locations_file')->isValid()) {
                $uploaded_file = Input::file('locations_file');
                $uploaded_file_extension = $uploaded_file->getClientOriginalExtension();
                $uploaded_file_name = $this->businessID . '_' . time() . '.' . $uploaded_file_extension;
                $uploaded_file->storeAs('business/location_files/', $uploaded_file_name);

                // sending email to admins

                Mail::to(env('SUPPORT_EMAIL', 'support@jobmap.co'))->queue(new \App\Mail\BusinessUploadedLocationsFile($business, $uploaded_file_name, 'INITIAL', $this->auth->language_prefix));
            }
        }
        
        $data['token'] = $this->token;
        return $data;
    }
}

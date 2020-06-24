<?php

namespace App\GraphQL\Mutation\User\Business;

use App\Business\Administrator;
use App\GraphQL\Auth;
use App\Business;
use App\GraphQL\AuthBusiness;
use App\Keyword;
use App\Rules\CheckValidGeo;
use Folklore\GraphQL\Error\ValidationError;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Delete Business'
    ];
    
    public function type()
    {
        return GraphQL::type('Business');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['required']
        ];
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
        ];
        //set permissions for this object
        $this->permissions = [
            'brands'
        ];
        //set business ID
        $this->businessID = $args['id'];
        //check permissions
        $this->check();
        
        DB::beginTransaction();

        try {

            Business::where([
                'id' => $args['id']
            ])->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }
        
        return ['token' => $this->token];
    }
}

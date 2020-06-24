<?php

namespace App\GraphQL\Mutation\User\Resume;

use App\GraphQL\Auth;
use App\JobCategory;
use App\User;
use App\User\Resume\Preference;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\App;

class UpdatePreferenceMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'UpdateUserPreference'
    ];
    
    public function type()
    {
        return GraphQL::type('UserPreference');
    }
    
    protected function rules()
    {
        return [
            'looking_job' => ['required', 'string'],
            'current_type' => ['required'],
            'current_job' => ['required'],
            'new_job' => ['required', 'string'],
            'new_opportunities' => ['required', 'string'],
            'distance' => ['required', 'numeric'],
            'distance_type' => ['required', 'string'],
            'industries' => ['required', 'string'],
//            'categories' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'hours_from' => ['required', 'numeric'],
            'hours_to' => ['required', 'numeric']
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'looking_job' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Looking job right now'
            ],
            'current_type' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Im a '
            ],
            'current_job' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Im now'
            ],
            'interested_jobs' => [
                'type' => Type::string(),
                'description' => 'What type of jobs you are interested in'
            ],
            'new_job' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'New job opportunities'
            ],
            'new_opportunities' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'New opportunities'
            ],
            'distance' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Maximum distance to job'
            ],
            'distance_type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Distance Type - km|miles'
            ],
            'industries' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User industries of interest'
            ],
            'sub_industries' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User sub-industries of interest'
            ],
//            'categories' => [
//                'type' => Type::nonNull(Type::string()),
//                'description' => 'User categories of interest'
//            ],
            'sub_categories' => [
                'type' => Type::string(),
                'description' => 'User sub-categories of interest'
            ],
            'salary' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User hourly salary'
            ],
            'hours_from' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'User weekly hours from'
            ],
            'hours_to' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'User weekly hours to'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return null
     */
    public function resolve($root, $args)
    {
        $update = [];

        if (isset($args['sub_industries'])) {
            if ($args['sub_industries'] == 0) {
                $update['sub_industries'] = null;
            }
            else {
                $update['sub_industries'] = $args['sub_industries'];
            }
        }
        
        if (isset($args['sub_categories'])) {
            /*if ($args['sub_categories'] == 0) {
                $update['sub_categories'] = null;
            }
            else {
                $update['sub_categories'] = $args['sub_categories'];
            }*/
            $str = '';
            $sub_categories = explode(",", $args['sub_categories']);
            foreach($sub_categories as $item) {
                if (is_numeric($item)) {
                    if (strlen($str) > 0) {
                        $str .= ',';
                    }
                    $str .= $item;
                } else {
                    $itemNew = '';
                    if (App::isLocale('fr')) {
                        if ($jc = JobCategory::where('name_fr',$item)->whereNull('parent_id')->first()) {
                            $itemNew = $jc->id;
                        }
                    } else {
                        if ($jc = JobCategory::where('name',$item)->whereNull('parent_id')->first()) {
                            $itemNew = $jc->id;
                        }
                    }
                    if ($itemNew ==0) {
                        $newJC = JobCategory::create([
                            'parent_id' => 20800,
                            'name' => $item,
                            'name_fr' => $item
                        ]);
                        $itemNew = $newJC->id;
                    }
                    if (strlen($str) > 0) {
                        $str .= ',';
                    }
                    $str .= $itemNew;
                }
            }
            $update['sub_categories'] = $str;
        }

        $fieldsFirstLetter = [
            'looking_job',
            'new_job',
            'new_opportunities',
            'distance_type',
        ];

        foreach ($args as $field => $value) {
            if($field !== 'sub_industries' && $field !== 'sub_categories') {
                if (in_array($field,$fieldsFirstLetter)) {
                    $update[$field] = ucfirst($value);
                }
                else {
                    $update[$field] = $value;
                }
            }
        }

        $update['is_complete'] = 1;
        $preference = Preference::where('user_id', $this->auth->id)->update($update);

        $query = Preference::query();
        $query->where('user_id', $this->auth->id);
        $preference = $query->first();
        $preference->token = $this->token;

        $user = User::find($this->auth->id);
        //$user->recalculateResumeIsCompleted();
        $user->updated_at = $preference['updated_at'];
        $user->save();
    
        return $preference;
    }
}

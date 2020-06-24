<?php

namespace App\GraphQL\Mutation\User;

use App\Mail\InvitationAcademy;
use App\User;
use App\User\Academy\Director;
use App\User\Academy\Student;
use App\User\Academy\Teacher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class InviteChildAcademyMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newChildAcademy'
    ];
    
    public function type()
    {
        return GraphQL::type('Academy');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => ['required', 'email']
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'token' => [
                'name' => 'token',
                'type' => Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'type' => [
                'name' => 'type',
                'type' => Type::nonNull(Type::string()),
            ],
            'resend' => [
                'name' => 'resend',
                'type' => Type::nonNull(Type::int()),
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
        $resend = $args['resend']=='0' ? false : true;
        $typeChild = $args['type'] == 'teacher' ? 'student' : 'teacher';
        /*DB::beginTransaction();
        try {*/
            $data = [];
            $children = [];
            $itemActive = 'children_inactive';
            $itemInActive = 'children_active';
            if (!$resend) {
                if ($user = User::where('email',$args['email'])->first()) {
                    $data['user_id'] = $user->id;
                    //$userChild->user;
                    $itemActive = 'children_active';
                    $itemInActive = 'children_inactive';
                }
                if ($args['type'] == 'teacher') {
                    $userParent = Teacher::with('students')->where('token',$args['token'])->first();
                    if ($userChild = Student::where('email', $args['email'])->first()) {
                        $userChild->update($data);
                        if ($userParent->students->count() && in_array($userChild->id,$userParent->students->pluck('id')->toArray())) {
                            $resend = true;
                        } else {
                            $userParent->students()->attach($userChild->id);
                        }
                    } else {
                        $data['email'] = $args['email'];
                        $userChild = Student::create($data);
                        $userParent->students()->attach($userChild->id);
                    }
                } else {
                    $userParent = Director::with('teachers')->where('token',$args['token'])->first();
                    if ($userChild = Teacher::where('email', $args['email'])->first()) {
                        $userChild->update($data);
                        if ($userParent->teachers->count() &&in_array($userChild->id,$userParent->teachers->pluck('id')->toArray())) {
                            $resend = true;
                        } else {
                            $userParent->teachers()->attach($userChild->id);
                        }
                    } else {
                        $data['email'] = $args['email'];
                        $userChild = Teacher::create($data);
                        $userParent->teachers()->attach($userChild->id);
                    }
                }
                if (!$resend) {
                    $children[] = $userChild;
                } else {
                    throw new UnauthorizedHttpException('auth', 'A ' . $typeChild . ' with such an email already exists on your list.');
                }
            } else {
                if ($args['type'] == 'teacher') {
                    $userChild = Student::with('user')->where('email', $args['email'])->first();
                    $userParent = Teacher::where('token',$args['token'])->first();
                } else {
                    $userChild = Teacher::with('user')->where('email', $args['email'])->first();
                    $userParent = Director::where('token',$args['token'])->first();
                }
            }

            Mail::to($userChild->email)
                ->queue(new InvitationAcademy($args['type'], $userChild, $userParent, $this->auth->language_prefix));

            /*DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }*/

        return [
            $itemActive => $children,
            $itemInActive => []
        ];
    }
}

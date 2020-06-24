<?php

namespace App\GraphQL\Mutation\User\Business\Import;

use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\Business\Import;
use App\Business\Location;
use App\Business\Pipeline;
use App\Candidate\Candidate;
use App\GraphQL\Auth;
use App\Business;
use App\Keyword;
use App\Mail\SendInvitationATS;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
//use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CreateImportMutation extends Mutation
{
    //use JWT authorization
    use Auth;

    protected $attributes = [
        'name' => 'Import single email'
    ];

    public function type()
    {
        return GraphQL::type('Ats');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'business_id' => ['required'],
            'email' => ['required', 'email'],
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
            'email' => [
                'type' => Type::string(),
                'description' => 'Email'
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $this->checkBusinessAccess($args['business_id'], [
            \App\Business\Administrator::MANAGER_ROLE,
            \App\Business\Administrator::BRANCH_ROLE,
        ]);

        DB::beginTransaction();

        try {
            $business = \App\Business::where('id', $args['business_id'])->first();

            if (!$import = Import::where('email', $args['email'])->where('business_id', $business->id)->first()) {
                $import = new Import;
                $import->business_id = $business->id;
                $import->email = $args['email'];
            }

            if ($user = User::where('email', $args['email'])->first()) {
                $candidate = Candidate::where('user_id', $user->id)->where('business_id', $business->id)->first();

                if (!$candidate) {
                    $candidate = new Candidate;
                    $candidate->user_id = $user->id;
                    $candidate->business_id = $business->id;
                    $candidate->pipeline = 'ats';
                    $candidate->save();
                }

                $import->status = 'Exist';
            }
            else {
                $import->status = 'Pending';
                $import->affiliate_token = md5(str_random(24));
                ++$import->send_count;
                $import->sended_at = new \DateTime;
                Mail::to($args['email'])->queue(new SendInvitationATS($business, $import, 'INITIAL', $this->auth->language_prefix));
            }

            $import->save();
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollback();
            return null;
        }

        $data = [];
        $data['status'] = $import->status;
        $data['token'] = $this->token;
        return $data;
    }
}

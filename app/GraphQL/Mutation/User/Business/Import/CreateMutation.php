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

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;

    protected $attributes = [
        'name' => 'Import ATS'
    ];

    public function type()
    {
        return GraphQL::type('AtsList');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [

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

            if (Input::hasFile('ats')) {
                try {
                    ini_set('memory_limit', '-1');
                    $all_data = [];

                    foreach (Input::file('ats') as $file) {
                        $filename = $file->getPathName();
                        $extension = substr(strrchr($file->getClientOriginalName(), '.'), 1);

                        switch ($extension) {
                            case 'csv':
                            {
                                $files = fopen($filename, 'rb');

                                while (($data = fgetcsv($files, 200, ',')) !== FALSE) {
                                    foreach ($data as $field) {
                                        if (filter_var($field, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $field)) {
                                            if (!in_array($field, $all_data)) {
                                                $all_data[] = $field;
                                            }
                                        }
                                    }
                                }

                                fclose($files);
                                break;
                            }
                            case 'xls':
                            {
                                $readerXLS = new Xls();

                                try {
                                    $spreadsheet = $readerXLS->load($filename);
                                    $i = 0;
                                    $sheetCount = $spreadsheet->getSheetCount() - 1;

                                    while ($spreadsheet->setActiveSheetIndex($i)) {
                                        $worksheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                                        foreach ($worksheet as $row) {
                                            foreach ($row as $key => $field) {
                                                if (filter_var($field, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $field)) {
                                                    if (!in_array($field, $all_data)) {
                                                        $all_data[] = $field;
                                                    }
                                                }
                                            }
                                        }

                                        if ($i < $sheetCount) {
                                            ++$i;
                                            continue;
                                        }

                                        break;
                                    }
                                }
                                catch (Exception $e) {
                                    var_dump($e);
                                }
                                catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
                                    var_dump($e);
                                }

                                break;
                            }
                            case 'xlsx':
                            {
                                $reader = new Xlsx();

                                try {
                                    $spreadsheet = $reader->load($filename);
                                    $i = 0;
                                    $sheetCount = $spreadsheet->getSheetCount() - 1;

                                    while ($spreadsheet->setActiveSheetIndex($i)) {
                                        $worksheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                                        foreach ($worksheet as $row) {
                                            foreach ($row as $key => $field) {
                                                if (filter_var($field, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $field)) {
                                                    if (!in_array($field, $all_data)) {
                                                        $all_data[] = $field;
                                                    }
                                                }
                                            }
                                        }

                                        if ($i < $sheetCount) {
                                            ++$i;
                                            continue;
                                        }

                                        break;
                                    }
                                }
                                catch (Exception $e) {
                                    var_dump($e);
                                }
                                catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
                                    var_dump($e);
                                }

                                break;
                            }
                        }
                    }

                    $imports = collect();

                    foreach ($all_data as $value) {
                        if (!$import = Import::query()->where('email', $value)->where('business_id', $business->id)->first()) {
                            $import = new Import;
                            $import->business_id = $business->id;
                            $import->email = $value;
                        }

                        if ($user = User::where('email', $value)->first()) {
                            $import->status = 'Exist';
                            $candidate = Candidate::where('user_id', $user->id)->where('business_id', $business->id)->first();

                            if (!$candidate) {
                                $candidate = new Candidate;
                                $candidate->user_id = $user->id;
                                $candidate->business_id = $business->id;
                                $candidate->pipeline = 'invited';
                                $candidate->save();
                            }
                        }
                        else {
                            $import->status = 'Pending';
                            $import->affiliate_token = md5(str_random(24));
                            ++$import->send_count;
                            Mail::to($value)->queue(new SendInvitationATS($business, $import, 'INITIAL', $this->auth->language_prefix));
                        }

                        $import->save();
                        $imports->push($import);
                    }
                }
                catch (\Exception $e) {
                    throw new \Exception('Processing error');
                }
            }

            DB::commit();
        }
        catch (Exception $e) {
            DB::rollback();
            return null;
        }

        $data['items'] = $imports->toArray();
        $data['count'] = $imports->count();
        $data['token'] = $this->token;
        return $data;
    }
}

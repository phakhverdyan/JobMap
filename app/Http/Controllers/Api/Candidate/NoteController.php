<?php
namespace App\Http\Controllers\Api\Candidate;

use App\Business;
use App\Business\Administrator;
use App\Candidate\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\Candidate\BaseController;


class NoteController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get(Request $request)
    {
        $this->business_id = (int)$request->input('business_id', 0);
        //$candidate_id = (int)$request->input('candidate_id', 0);
        $user_id = (int)$request->input('user_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);

        if($brand_id == 0){
            $brand_id = $this->business_id;
        }

        //check permissions
        $this->check();

        $data_query = [
            'candidate_user_id' => $user_id,
            'business_id' => $brand_id,
        ];

        $auth_manager_role = get_manager_role($this->business_id);
        if ($auth_manager_role && $auth_manager_role === Administrator::FRANCHISE_ROLE) {
            $data_query['manager_user_id'] = Auth::user()->getKey();
        }

        $note_query = Note::where($data_query)->get()->all();

        $response = [];

        foreach ($note_query as $item) {

            $days = $this->getDays($item['updated_at']);

            Carbon::setLocale( $this->getLocale());

            $response[] = [
                'id' => $item['id'],
                'manager' => $item['manager'],
                'message' => $item['message'],
                'rating' => $item['rating'],
                'attach_file' => $item['attach_file'],
                'date' => ($days == 0) ? trans('fields.today') : Carbon::now()->subDays($days)->diffForHumans()
            ];
        }

        return response([ 'data' => ["items" => $response]], 200);
    }

    public function create(Request $request)
    {
        $this->business_id = (int)$request->input('business_id', 0);
        //$candidate_id = (int)$request->input('candidate_id', 0);
        $user_id = (int)$request->input('user_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $this->business_id;
        }

        //check permissions
        $this->check();

        $validator = validator()->make($request->all(), [
            'message' => 'required|string',
            //'rating' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => 'validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }

        $note_query = new Note();
        $note_query->business_id = $brand_id;
        $note_query->message = $request->input('message', "");
        $rating = $request->input('rating', "");
        if (!empty($rating)) {
            $note_query->rating = $rating;
        } else {
            $note_query->rating = null;
        }
        $note_query->candidate_user_id = $user_id;
        $note_query->manager_user_id = Auth::user()->getKey();

        if (Input::hasFile('attach_file')) {
            if (Input::file('attach_file')->isValid()) {
                try {
                    ini_set('memory_limit', '-1');
                    $input_image = Input::file('attach_file');
                    if ($input_image->getClientSize() < 10000000) {
                        $storage = 'candidates/' . $note_query->candidate_user_id . '/';
                        $input_image->storeAs($storage, $input_image->getClientOriginalName());
                        $note_query->attach_file = $input_image->getClientOriginalName();
                    } else {
                        $errorMessage = $input_image->getClientSize() . 'byte';
                        return response([
                            'error' => 'file',
                            'message' => $errorMessage,
                        ], 400);
                    }
                } catch (\Exception $e) {
                    return response([
                        'error' => 'exception',
                        'message' => $e->getMessage(),
                    ], 400);
                }
            }
        }
        $note_query->save();

        return $this->get($request);
    }

    public function delete(Request $request)
    {
        $this->business_id = (int)$request->input('business_id', 0);
        $note_id = (int)$request->input('note_id', 0);
        $user_id = (int)$request->input('user_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $this->business_id;
        }

        //check permissions
        $this->check();

        $data_query = [
            'id' => $note_id,
            'candidate_user_id' => $user_id,
            'business_id' => $brand_id,
        ];

        Note::where($data_query)->delete();

        return $this->get($request);
    }


}

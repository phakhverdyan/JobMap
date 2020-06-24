<?php
namespace App\Http\Controllers\Api\Candidate;

use App\Business;
use App\Business\Administrator;
use App\Business\Pipeline;
use App\Candidate\Candidate;
use App\Candidate\History;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\Candidate\BaseController;


class PipelineController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get(Request $request)
    {
        $this->business_id = (int)$request->input('business_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        $keywords = $request->input('keywords', "");
        $filter_by_location_ids = $request->input('filter_by_location', []);
        if($brand_id == 0){
            $brand_id = $this->business_id;
        }

        $this->check();

        $pipeline_query = Pipeline::where('business_id', $this->business_id)->get();

        $current_locale = $this->getLocale();

        $pipeline_data = $pipeline_query->transform(function($value) use($current_locale, $brand_id, $keywords, $filter_by_location_ids){
            $value['localized_name'] = $value['name'. ($current_locale == 'en' ? '' : '_' . $current_locale)];
            $value['candidates'] = $this->getCandidateCount($brand_id, $value['id'], $value['type'], $keywords, $filter_by_location_ids);
            $value['waving_candidates'] = $this->getWavingCandidateCount($brand_id, $value['id'], $value['type']);
            return $value;
        });

        return response([ 'data' => ["items" => $pipeline_data]], 200);
    }

    public function create(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }


}

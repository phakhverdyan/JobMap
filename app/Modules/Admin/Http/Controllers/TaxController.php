<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Modules\Admin\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TaxController extends Controller
{
    public function index()
    {
        $tax_config = DB::table('nexus_initial_tax_config')->first();
        $taxes = DB::table('taxes')->get();

//        dd($taxes);

        return view('admin::tax.index', compact('tax_config', 'taxes'));
    }

    public function update()
    {
//        dd(request()->all());
        $this->validate(request(), [
            'gst_number' => 'required',
            'qst_number' => 'required',
            'qc_company_number' => 'required',

            'province_fr' => 'required|array',
            'province_fr.*' => 'required',
            'province_en' => 'required|array',
            'province_en.*' => 'required',
        ]);

        if (!request('tax_config_id')) {
            DB::table('nexus_initial_tax_config')
                ->insert([
                    'gst_number' => request('gst_number'),
                    'qst_number' => request('qst_number'),
                    'qc_company_number' => request('qc_company_number'),
                ]);
        }

        DB::table('nexus_initial_tax_config')
            ->where('id', request('tax_config_id'))
            ->update([
                'gst_number' => request('gst_number'),
                'qst_number' => request('qst_number'),
                'qc_company_number' => request('qc_company_number'),
            ]);

        $id = request('id');
        $province_fr = request('province_fr');
        $province_en = request('province_en');
        $type_1 = request('type_1');
        $rate_1 = request('rate_1');
        $type_2 = request('type_2');
        $rate_2 = request('rate_2');

        $count = count($id);

        for ($i=0; $i<$count; $i++) {

            DB::table('taxes')
                ->where('id', $id[$i])
                ->update([
                    'province_fr' => $province_fr[$i],
                    'province_en' => $province_en[$i],
                    'type_1' => $type_1[$i],
                    'rate_1' => $rate_1[$i],
                    'type_2' => $type_2[$i],
                    'rate_2' => $rate_2[$i],
                ]);
        }

        return redirect()->back();
    }
}

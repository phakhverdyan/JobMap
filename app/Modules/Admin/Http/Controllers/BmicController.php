<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Models\BigMacIndex;
use App\Modules\Admin\Models\Country;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Modules\Admin\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BmicController extends Controller
{
    public function index()
    {
        $flagship_coefficient = DB::table('flagship_coefficient')->first();

        $countries = DB::table('countries')->get();

        $indexes = BigMacIndex::all();

        return view('admin::bmic.index', compact('indexes', 'countries', 'flagship_coefficient'));
    }

    public function price()
    {
        $data = [
            'plans' => DB::table('monthly_plans')->orderBy('order', 'ASC')->get(),
            'packages' => DB::table('addon_packages')->orderBy('order', 'ASC')->get()
        ];
        return response()->json($data);
    }

    public function store()
    {
//        dd(request());

        $this->validate(request(), [
            'country_name' => 'required',
            'coefficient' => 'required',
        ]);

        BigMacIndex::create([
            'flag' => request('flag'),
            'country_code' => request('country_code'),
            'country_name' => request('country_name'),
            'coefficient' => request('coefficient'),
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {

        $item = BigMacIndex::find($id);

        $item->delete();

        return redirect()->back();
    }

    public function update($id)
    {
        $item = BigMacIndex::find($id);
        $item->coefficient = request('coefficient');
        $item->save();

        return redirect()->back();
    }

    public function store_coefficient()
    {
        $this->validate(request(), [
            'flagship-coefficient' => 'required|numeric|min:0.01'
        ]);

        DB::table('flagship_coefficient')->delete();

        DB::table('flagship_coefficient')
            ->insert([
                'coefficient' => request('flagship-coefficient')
            ]);

        return redirect()->back();
    }
}

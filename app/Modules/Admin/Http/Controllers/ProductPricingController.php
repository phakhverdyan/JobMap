<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Modules\Admin\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class ProductPricingController extends Controller
{
    public function index()
    {
        $pricePerLocations = DB::table('price_per_locations')->get();
        $pricePerSeats = DB::table('price_per_seates')->get();

        return view('admin::product-pricing.index', compact('pricePerLocations', 'pricePerSeats'));
    }

    public function update()
    {
        $this->validate(request(), [
            "location_from" => 'required|array',
            "location_from.*" => 'required|numeric',
            "location_to" => 'required|array',
            "location_to.*" => 'required|numeric',
            "location_price" => 'required|array',
            "location_price.*" => 'required|numeric',

            "seats_from" => 'required|array',
            "seats_from.*" => 'required|numeric',
            "seats_to" => 'required|array',
            "seats_to.*" => 'required|numeric',
            "seats_price" => 'required|array',
            "seats_price.*" => 'required|numeric',
        ]);

        $location_id = request('location_id');
        $location_from = request('location_from');
        $location_to = request('location_to');
        $location_price = request('location_price');

        $location_count = count($location_id);

        for ($i=0; $i<$location_count; $i++) {

            DB::table('price_per_locations')
                ->where('id', $location_id[$i])
                ->update([
                    'from' => $location_from[$i],
                    'to' => $location_to[$i],
                    'price' => $location_price[$i],
                ]);
        }

        $seats_id = request('seats_id');
        $seats_from = request('seats_from');
        $seats_to = request('seats_to');
        $seats_price = request('seats_price');

        $seats_count = count($seats_id);

        for ($i=0; $i<$seats_count; $i++) {
            DB::table('price_per_seates')
                ->where('id', $seats_id[$i])
                ->update([
                    'from' => $seats_from[$i],
                    'to' => $seats_to[$i],
                    'price' => $seats_price[$i],
                ]);
        }

        return redirect()->back();
    }
}

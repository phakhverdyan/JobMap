<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Models\Discount;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Modules\Admin\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();

        return view('admin::discount.index', compact('discounts'));
    }

    public function store()
    {

        $this->validate(request(),[
            'name' => 'required',
            'code' => 'required|unique:discounts',
            'off_an_plans_value' => 'required',
            'off_an_plans_type' => 'required',
            'off_on_month_value' =>  'required',
            'off_on_month_type' => 'required',
            'duration_value' => 'required',
            'status'=> ''
        ]);

        Discount::create([
            'name' => request('name'),
            'code' => request('code'),
            'off_an_plans_value' => request('off_an_plans_value'),
            'off_an_plans_type' => request('off_an_plans_type'),
            'off_on_month_value' => request('off_on_month_value'),
            'off_on_month_type' => request('off_on_month_type'),
            'duration_value' => request('duration_value'),
            'status' => request('status'),
        ]);

        return redirect()->back();
    }

    public function update($id)
    {
        $discount = Discount::find($id);

        $discount->name = request('name');
        $discount->code = request('code');
        $discount->off_an_plans_value = request('off_an_plans_value');
        $discount->off_an_plans_type = request('off_an_plans_type');
        $discount->off_on_month_value = request('off_on_month_value');
        $discount->off_on_month_type = request('off_on_month_type');
        $discount->duration_value = request('duration_value');
        $discount->status = request('status');

        $discount->save();

        return redirect()->back();

    }
}

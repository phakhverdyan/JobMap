<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PricingStrategyController extends Controller
{
    public function index()
    {
        $pricing_strategy = DB::table('pricing_strategy')->where('active', 1)->first();
        return view('admin::pricing-strategy.index', compact('pricing_strategy'));
    }

    public function update()
    {
        $this->validate(request(), [
            "monthly_price" => 'required|integer',
            "candidates" => 'required|integer',
        ]);

        $monthly_price = request('monthly_price');
        $candidates = request('candidates');
        $free_version_candidates = request('free_version_candidates');

        if ($free_version_candidates >= $candidates) {
            $free_version_candidates = $candidates - 1;
        }

        DB::table('pricing_strategy')->where('active', 1)->update([
            'active' => 0,
        ]);

        DB::table('pricing_strategy')->insert([
            'monthly_price' => $monthly_price,
            'candidates' => $candidates,
            'free_version_candidates' => $free_version_candidates,
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s e')
        ]);

        return redirect()->back();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Tax;


class TaxRateIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
        foreach (Tax::all() as $item) {
            if ($item->type_1)
            {
                $tax_rate_1 = \Stripe\TaxRate::create([
                    'display_name' => $item->type_1,
                    'description' => $item->province_en.' '.$item->type_1,
                    'jurisdiction' => $item->code,
                    'percentage' => $item->rate_1,
                    'inclusive' => false,
                  ]);
                $item->tax_rate_1_id = $tax_rate_1->id;
            }
            if ($item->type_2)
            {
                $tax_rate_2 = \Stripe\TaxRate::create([
                    'display_name' => $item->type_2,
                    'description' => $item->province_en.' '.$item->type_2,
                    'jurisdiction' => $item->code,
                    'percentage' => $item->rate_2,
                    'inclusive' => false,
                  ]);
                $item->tax_rate_2_id = $tax_rate_2->id;
            }
            $item->save();
        }
    }
}

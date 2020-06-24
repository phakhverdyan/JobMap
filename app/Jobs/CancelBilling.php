<?php

namespace App\Jobs;

use App\Business;
use App\MonthlyPlan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CancelBilling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $business = Business::query()->where('id', '=', $this->data['business_id'])->first();
        $monthlyPlan = MonthlyPlan::query()->where('id', '=', $business->plan_id)->first();
        $monthlyPlanFree = MonthlyPlan::query()->where('price', '=', '0')->first();
        $business->plan_id = 0;
        $business->job_id = 0;
        $business->applicants = (int)$business->applicants - (int)$monthlyPlan->applicants + (int)$monthlyPlanFree->applicants;
        $business->save();
    }
}

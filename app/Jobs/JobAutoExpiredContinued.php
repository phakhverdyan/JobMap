<?php

namespace App\Jobs;

use App\Business\Job;
use App\Business\JobLocation;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class JobAutoExpiredContinued implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $jobId;

    /**
     * Create a new job instance.
     *
     * @param Billing $billing
     */
    public function __construct( $jobId )
    {
        $this->jobId = $jobId;
    }

    /**
     * Execute the job.
     *
     * @param Billing $billing
     * @return void
     */
    public function handle()
    {
        //$dayExpiredJob = Config::get('queue.day_job_expired');
        Log::info('-----id-------------'.$this->jobId);
        $job = Job::with('business', 'locations')->find($this->jobId);

        if ($job->business->plan_id == 0) {
            if ($job->status) {
                $job->status = 0;
                $job->save();
            }

            JobLocation::where('job_id', $this->jobId)->where('status', 1)->update(['status' => 0]);
            Log::info('-----expired-------------');
        } else {
            $job->created_at = time();
            $job->save();
            Log::info('-----continue-------------');
        }
    }

    public function failed(Exception $exception)
    {
        Log::info('-----error-------------'.$exception);
//        print_r($exception, true);
        // Отправить пользователю уведомление об ошибке, и т.п. ...
    }

}

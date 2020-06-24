<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\LocalizatedMailable;
use App\Business\Administrator;
use App\Business\BusinessBilling;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;


class CandidateApplyJob extends Mailable
{
    use Queueable, SerializesModels;

    protected $candidate_job;
    protected $candidate_location;
    protected $user;
    protected $business_creator;
    protected $business;
    protected $job_title;
    protected $location_title;
    protected $job_url;
    protected $location_url;
    protected $language_prefix;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($candidate_job, $candidate_location, $user, $business_creator, $business, $job_title, $location_title, $job_url, $location_url, $language_prefix = "en")
    {
        $this->candidate_job = $candidate_job;
        $this->candidate_location = $candidate_location;
        $this->user = $user;
        $this->business_creator = $business_creator;
        $this->business = $business;
        $this->job_title = $job_title;
        $this->location_title = $location_title;
        $this->job_url = $job_url;
        $this->location_url = $location_url;
        $this->language_prefix = $language_prefix;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subscribe = false;
        $created = new Carbon(Administrator::where('user_id',$this->business_creator->id)
        ->where('business_id',$this->business->id)
        ->first()
        ->created_at);
        $trial_days = 30 - $created->diff(Carbon::now())->days;

        if ($trial_days <= 0)
        {
            $paid = BusinessBilling::where('user_id',$this->business_creator->id)
            ->where('business_id',$this->business->id)
            ->where('status','active')
            ->first();
            if (!$paid)
            {
                $this->user->full_name = "new user";
                $subscribe = true;
            }
        }

        $initialize = $this->view('emails.'.$this->language_prefix.'.candidate.candidate_applied_job', [
            'user'     => $this->user,
            'job'      => $this->candidate_job,
            'location' => $this->candidate_location,
            'job_title' => $this->job_title,
            'location_title' => $this->location_title,
            'job_url' => $this->job_url,
            'location_url' => $this->location_url,
            'subscribe' => $subscribe
        ]);

        if(!empty($this->user->attach_file) && !$subscribe){
            $resumePath = config('files.widget.resume_path');
            $filePath = sprintf($resumePath, $this->user->id, $this->user->attach_file);

            //$initialize = $initialize->attach("storage/app/".$filePath);
            $initialize = $initialize->attach(Storage::path($filePath));
        }
        return $initialize;
    }
}

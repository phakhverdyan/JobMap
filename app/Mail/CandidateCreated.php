<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use App\Business\Administrator;
use App\Business\BusinessBilling;
use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailable;

class CandidateCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $business_creator;
    protected $business;
    protected $user;
    protected $candidate_job;
    protected $candidate_location;
    protected $business_confirmed;
    protected $mail_type;
    protected $language_prefix;

    /**
     * UserNotifications constructor.
     * @param Business $business
     */
    public function __construct(
        $business_creator,
        $business,
        $user,
        $candidate_job,
        $candidate_location,
        $business_confirmed = false,
        $mail_type = 'INITIAL',
        $language_prefix = "en"
    ) {
        $this->business_creator         = $business_creator;
        $this->business                 = $business;
        $this->user                     = $user;
        $this->candidate_job            = $candidate_job;
        $this->candidate_location       = $candidate_location;
        $this->business_confirmed       = $business_confirmed;
        $this->mail_type                = $mail_type;
        $this->language_prefix          = $language_prefix;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subscribe = false;
        if ($this->mail_type == 'INITIAL') {
            if ($this->business_confirmed) {

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

                $initialize = $this->view('emails.'.$this->language_prefix.'.candidate.candidate_created', [
                    'business_creator'      => $this->business_creator,
                    'business'              => $this->business,
                    'user'                  => $this->user,
                    'job'                   => $this->candidate_job,
                    'location'              => $this->candidate_location,
                    'subscribe'             => $subscribe
                ]);

                if(!empty($this->user->attach_file)){
                    $resumePath = config('files.widget.resume_path');
                    $filePath = sprintf($resumePath, $this->user->id, $this->user->attach_file);
                    $initialize = $initialize->attach(Storage::path($filePath));
                }
                return $initialize;
            }

            return $this->view('emails.'.$this->language_prefix.'.business.unconfirmed_business_new_applicant', [
                'business_creator'      => $this->business_creator,
                'business'              => $this->business,
                'user'                  => $this->user,
                'job'                   => $this->candidate_job,
                'location'              => $this->candidate_location,
            ]);
        }

        if ($this->mail_type == 'FOLLOW_UP1') {
            return $this->view('emails.'.$this->language_prefix.'.business.unconfirmed_business_new_applicant_creation_follow_up1', [
                'business_creator'      => $this->business_creator,
                'business'              => $this->business,
                'user'                  => $this->user,
                'job'                   => $this->candidate_job,
                'location'              => $this->candidate_location,
            ]);
        }

        throw new \Exception('Wrong mail type: ' . $this->mail_type);
    }
}

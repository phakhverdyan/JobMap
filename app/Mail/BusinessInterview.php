<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class BusinessInterview extends Mailable
{
    use Queueable, SerializesModels;

    protected $interview_request;
    protected $user;
    protected $business;
    protected $business_creator;
    protected $mail_type;

    protected $language_prefix;

    /**
     * UserNotifications constructor.
     * @param User $user
     */
    public function __construct(\App\InterviewRequest $interview_request,
                                \App\User $user,
                                \App\Business $business,
                                \App\User $business_creator,
                                $mail_type,
                                $language_prefix = "en")
    {
        $this->interview_request    = $interview_request;
        $this->user                 = $user;
        $this->business             = $business;
        $this->business_creator     = $business_creator;
        $this->mail_type            = $mail_type;
        $this->language_prefix            = $language_prefix;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$this->locale($this->business_creator->lang->prefix);

        // if ($this->mail_type == 'REQUEST') {
        //     return $this->initialize('emails.user.user_interview_request', [], [
        //         'interview_request' => $this->interview_request,
        //         'user' => $this->user,
        //         'business' => $this->business,
        //     ]);
        // }

        if ($this->mail_type == 'ACCEPTED') {
            return $this->view('emails.'.$this->language_prefix.'.candidate.candidate_accepted_interview', [
                'interview_request' => $this->interview_request,
                'user' => $this->user,
                'business' => $this->business,
            ]);
        }

        // if ($this->mail_type == 'REMINDER') {
        //     return $this->initialize('emails.user.user_interview_reminder', [], [
        //         'interview_request' => $this->interview_request,
        //         'user' => $this->user,
        //         'business' => $this->business,
        //     ]);
        // }

        if ($this->mail_type == 'CHANGE') {
            return $this->view('emails.'.$this->language_prefix.'.candidate.candidate_asked_changes_for_interview', [
                'interview_request' => $this->interview_request,
                'user' => $this->user,
                'business' => $this->business,
            ]);
        }

        // if ($this->mail_type == 'CHANGE_FOLLOW_UP1') {
        //     return $this->initialize('emails.user.user_interview_change_follow_up1', [], [
        //         'interview_request' => $this->interview_request,
        //         'user' => $this->user,
        //         'business' => $this->business,
        //     ]);
        // }

        throw new \Exception('Wrong mail type');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class CandidateUpdatedProfile extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $business;
    protected $user;
    protected $mail_type;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param Business $business
     */
    public function __construct($business, $user, $mail_type = 'INITIAL', $language_prefix = "en") {
        $this->business                 = $business;
        $this->user                     = $user;
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
        if ($this->mail_type == 'INITIAL') {
            return $this->view('emails.'.$this->language_prefix.'.candidate.candidate_updated_profile', [
                'business' => $this->business,
                'user' => $this->user,
            ]);
        }

        throw new \Exception('Wrong mail type: ' . $this->mail_type);
    }
}

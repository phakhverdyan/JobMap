<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;

class BusinessCompletedAccount extends LocalizatedMailable
{
    use Queueable, SerializesModels;
    
    protected $business;
    protected $mail_type;

    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param User $business
     */
    public function __construct(\App\Business $business, $mail_type = 'INITIAL', $language_prefix = "en")
    {
        $this->business     = $business;
        $this->mail_type    = $mail_type;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->locale($this->business->admin->user->lang->prefix);

        if ($this->mail_type == 'INITIAL') {
            return $this->initialize('emails.'.$this->language_prefix.'.business.business_completed_account', [], [
                'business' => $this->business,
            ]);
        }
    }
}

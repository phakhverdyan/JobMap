<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class BusinessFeedback extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $business;
    protected $mail_type;

    protected $language_prefix;

    
    /**
     * UserNotifications constructor.
     * @param User $business
     */
    public function __construct(User $business, $mail_type = 'INITIAL', $language_prefix = "en")
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
        if ($this->mail_type == 'INITIAL') {
            return $this->view('emails.'.$this->language_prefix.'.business.business_feedback', [
                'business' => $this->business,
            ]);
        }
    }
}

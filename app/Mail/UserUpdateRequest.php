<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class UserUpdateRequest extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;
    protected $business;
    protected $mail_type;
    protected $language_prefix;

    /**
     * UserNotifications constructor.
     * @param User $user
     */
    public function __construct(\App\User $user, \App\Business $business, $mail_type = 'INITIAL', $language_prefix = "en")
    {
        $this->user             = $user;
        $this->business         = $business;
        $this->mail_type        = $mail_type;
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
            return $this->view('emails.'.$this->language_prefix.'.user.user_update_request', [
                'user' => $this->user,
                'business' => $this->business,
            ]);
        }

        if ($this->mail_type == 'FOLLOW_UP1') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_update_request_follow_up1', [
                'user' => $this->user,
                'business' => $this->business,
            ]);
        }

        throw \Exception('Wrong mail type');
    }
}
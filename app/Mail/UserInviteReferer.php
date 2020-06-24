<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class UserInviteReferer extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;
    protected $reference;
    protected $mail_number;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param User $user
     */
    public function __construct(\App\User $user, \App\User\Resume\Reference $reference, $mail_number, $language_prefix = "en")
    {
        $this->user             = $user;
        $this->reference        = $reference;
        $this->mail_number      = $mail_number;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->mail_number == 0) {
            return $this->view('emails.'.$this->language_prefix.'.user.user_invite_referer', [
                'user' => $this->user,
                'reference' => $this->reference,
            ]);
        }

        if ($this->mail_number == 1) {
            return $this->view('emails.'.$this->language_prefix.'.user.user_invite_referer_follow_up1', [
                'user' => $this->user,
                'reference' => $this->reference,
            ]);
        }

        if ($this->mail_number == 2) {
            return $this->view('emails.'.$this->language_prefix.'.user.user_invite_referer_follow_up2', [
                'user' => $this->user,
                'reference' => $this->reference,
            ]);
        }

        if ($this->mail_number == 3) {
            return $this->view('emails.'.$this->language_prefix.'.user.user_invite_referer_click1', [
                'user' => $this->user,
                'reference' => $this->reference,
            ]);
        }

        if ($this->mail_number == 4) {
            return $this->view('emails.'.$this->language_prefix.'.user.user_invite_referer_click2', [
                'user' => $this->user,
                'reference' => $this->reference,
            ]);
        }

        if ($this->mail_number == 5) {
            return $this->view('emails.'.$this->language_prefix.'.user.user_invite_referer_click3', [
                'user' => $this->user,
                'reference' => $this->reference,
            ]);
        }

        throw \Exception('Wrong mail number');
    }
}

<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class ResumeCompleted extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;
    protected $mail_type;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param User $user
     */
    public function __construct(User $user, $mail_type, $language_prefix = "en")
    {
        $this->user         = $user;
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
        if ($this->mail_type == 'FOLLOW_UP1') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_complete_registration_follow_up1', [
                'user' => $this->user,
            ]);
        }

        if ($this->mail_type == 'FOLLOW_UP2') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_complete_registration_follow_up2', [
                'user' => $this->user,
            ]);
        }

        if ($this->mail_type == 'FOLLOW_UP3') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_complete_registration_follow_up3', [
                'user' => $this->user,
            ]);
        }
        
        if ($this->mail_type == 'FOLLOW_UP4') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_complete_registration_follow_up4', [
                'user' => $this->user,
            ]);
        }

        if ($this->mail_type == 'COMPLETED') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_complete_registration_congratulation', [
                'user' => $this->user,
            ]);
        }

        throw new \Exception('Wrong mail type');
    }
}

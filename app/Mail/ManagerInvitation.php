<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class ManagerInvitation extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;
    protected $business_creator;
    protected $business;
    protected $mail_type;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param User $user
     */
    public function __construct(\App\User $user, \App\User $business_creator, \App\Business $business, $mail_type, $language_prefix = "en")
    {
        $this->user                 = $user;
        $this->business_creator     = $business_creator;
        $this->business             = $business;
        $this->mail_type            = $mail_type;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->mail_type == 'INVITE') {
            return $this->view('emails.'.$this->language_prefix.'.manager.manager_invitation', [
                'user' => $this->user,
                'business_creator' => $this->business_creator,
                'business' => $this->business,
            ]);
        }

        if ($this->mail_type == 'FOLLOW_UP1') {
            return $this->view('emails.'.$this->language_prefix.'.manager.manager_invitation_follow_up1', [
                'user' => $this->user,
                'business_creator' => null,
                'business' => $this->business,
            ]);
        }

        throw \Exception('Wrong mail type');
    }
}

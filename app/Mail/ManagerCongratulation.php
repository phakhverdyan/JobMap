<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class ManagerCongratulation extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;
    protected $mail_type;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param User $user
     */
    public function __construct(\App\User $user, $mail_type = 'INITIAL', $language_prefix = "en")
    {
        $this->user                 = $user;
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
        if ($this->mail_type == 'INITIAL') {
            return $this->view('emails.'.$this->language_prefix.'.manager.manager_congratulation', [
                'user' => $this->user,
            ]);
        }

        throw \Exception('Wrong mail type');
    }
}

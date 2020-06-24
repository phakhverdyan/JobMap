<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;

    protected $language_prefix;

    /**
     * UserNotifications constructor.
     * @param User $user
     */
    public function __construct(\App\User $user, $language_prefix = "en")
    {
        $this->user = $user;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New User!')->view('emails.'.$this->language_prefix.'.user.user_created', [
            'user' => $this->user,
        ]);
    }
}

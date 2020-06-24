<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyUserProfileSend extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    protected $user;
    protected $language_prefix;

    /**
     * UserNotifications constructor.
     * @param User $user
     * @param User $business
     * @param string $message
     */
    public function __construct($data, $user, $language_prefix)
    {
        $this->data = $data;
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
        return $this->subject(trans('emails.links.profile_subject', ['name' => $this->user->full_name]))
            ->view('emails.'.$this->language_prefix.'.user.send_my_user_profile', [
            'data' => $this->data,
            'user' => $this->user
        ]);
    }
}

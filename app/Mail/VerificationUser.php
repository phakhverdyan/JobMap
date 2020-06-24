<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class VerificationUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $mail_type;
    protected $data;
    protected $language_prefix;

    /**
     * UserNotifications constructor.
     * @param User $user
     */
    public function __construct(User $user, $language_prefix = "en", $mail_type = 'INITIAL', $data = [])
    {
        $this->user      = $user;
        $this->mail_type = $mail_type;
        $this->data      = $data;
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
            return $this->view('emails.'.$this->language_prefix.'.user.user_confirm_email', [
                'user' => $this->user,
                'tmp_password' => $this->data['tmp_password'] ?? null
            ]);
        }

        if ($this->mail_type == 'REMINDER') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_confirm_email_follow_up1', [
                'user' => $this->user,
            ]);
        }

        if ($this->mail_type == 'CONFIRMED') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_confirm_email_done', [
                'user' => $this->user,
            ]);
        }

        throw new \Exception('Wrong mail type');
    }
}

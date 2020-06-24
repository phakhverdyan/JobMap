<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackSend extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $business;
    protected $message_text;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param User $user
     * @param User $business
     * @param string $message
     */
    public function __construct($user, $business, $message_text, $language_prefix = "en")
    {
        $this->user             = $user;
        $this->business         = $business;
        $this->message_text     = $message_text;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Feedback from ' . ($this->business ? 'Business' : 'User'))->view('emails.'.$this->language_prefix.'.user.feedback', [
            'user'          => $this->user,
            'business'      => $this->business,
            'message_text'  => $this->message_text,
        ]);
    }
}

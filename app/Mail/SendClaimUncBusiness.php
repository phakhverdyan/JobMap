<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendClaimUncBusiness extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $data;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param User $user
     */
    public function __construct($data, $language_prefix = "en")
    {
        $this->data = $data;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Message from RequestCallback')
            ->view('emails.'.$this->language_prefix.'.send_claime_ubusiness', [
                'data' => $this->data
            ]);
    }
}

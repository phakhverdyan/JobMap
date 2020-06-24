<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferenceSend extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $reference;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param $user
     */
    public function __construct($reference, $language_prefix = "en")
    {
        $this->reference = $reference;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reference send')
            ->view('emails.'.$this->language_prefix.'.user.reference', [
                'reference' => $this->reference
            ]);
    }
}

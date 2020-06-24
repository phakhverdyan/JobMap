<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillingError extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    protected $language_prefix;

    /**
     * UserNotifications constructor.
     * @param $user
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
        return $this->subject('Payment Error')
            ->view('emails.'.$this->language_prefix.'.business.billing_error', [
                'data' => $this->data
            ]);
    }
}

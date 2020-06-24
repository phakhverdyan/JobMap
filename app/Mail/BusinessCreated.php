<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BusinessCreated extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $business;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param Business $business
     */
    public function __construct(\App\Business $business, $language_prefix = "en")
    {
        $this->business = $business;
        $this->language_prefix = $language_prefix ?: 'en';
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Business!')->view('emails.' . $this->language_prefix . '.business.business_created', [
            'business' => $this->business,
        ]);
    }
}

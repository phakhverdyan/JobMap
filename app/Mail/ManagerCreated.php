<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ManagerCreated extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $business;
    protected $user;
    protected $administrator;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param Business $business
     */
    public function __construct(\App\Business $business, \App\User $user, \App\Business\Administrator $administrator, $language_prefix = "en")
    {
        $this->business         = $business;
        $this->user             = $user;
        $this->administrator    = $administrator;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Manager!')->view('emails.'.$this->language_prefix.'.business.manager_created', [
            'business'          => $this->business,
            'user'              => $this->user,
            'administrator'     => $this->administrator,
        ]);
    }
}

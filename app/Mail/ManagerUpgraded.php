<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class ManagerUpgraded extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $business;
    protected $mail_type;
    // protected $user;
    // protected $administrator;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param Business $business
     */
    public function __construct($business, $mail_type, $language_prefix = "en")
    {
        $this->business         = $business;
        $this->mail_type        = $mail_type;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->mail_type == 'UPGRADED') {
            return $this->view('emails.manager.manager_upgraded', [
                'business' => $this->business,
            ]);
        }

        if ($this->mail_type == 'RETROGRADED') {
            return $this->view('emails.'.$this->language_prefix.'.manager.manager_retrograded', [
                'business' => $this->business,
            ]);
        }
    }
}

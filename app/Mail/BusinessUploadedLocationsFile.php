<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class BusinessUploadedLocationsFile extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $business;
    protected $file_name;
    protected $mail_type;
    protected $language_prefix;

    /**
     * UserNotifications constructor.
     * @param User $business
     */
    public function __construct(\App\Business $business, $file_name, $mail_type = 'INITIAL', $language_prefix = "en")
    {
        $this->business     = $business;
        $this->file_name    = $file_name;
        $this->mail_type    = $mail_type;
        $this->language_prefix    = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if ($this->mail_type == 'INITIAL') {
            return $this->view('emails.'.$this->language_prefix.'.business.business_uploaded_locations_file', [
                'business' => $this->business,
                'file_name' => $this->file_name,
            ]);
        }
    }
}

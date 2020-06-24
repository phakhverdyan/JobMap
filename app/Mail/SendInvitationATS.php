<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Mail\LocalizatedMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class SendInvitationATS extends Mailable
{
    use Queueable, SerializesModels;

    protected $business;
    protected $affiliate_token;
    protected $mail_type;
    protected $language_prefix;

    /**
     * UserNotifications constructor.
     * @param $user
     */
    public function __construct(\App\Business $business, \App\Business\Import $import, $mail_type = 'INITIAL', $language_prefix = "en")
    {
        $this->business         = $business;
        $this->affiliate_token  = $import->affiliate_token;
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
        if ($this->mail_type == 'INITIAL') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_business_invitation', [
                'business'          => $this->business,
                'affiliate_token'   => $this->affiliate_token,
            ]);
        }

        if ($this->mail_type == 'FOLLOW_UP1') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_business_invitation_follow_up1', [
                'business'          => $this->business,
                'affiliate_token'   => $this->affiliate_token,
            ]);
        }

        if ($this->mail_type == 'FOLLOW_UP2') {
            return $this->view('emails.'.$this->language_prefix.'.user.user_business_invitation_follow_up2', [
                'business'          => $this->business,
                'affiliate_token'   => $this->affiliate_token,
            ]);
        }

        throw \Exception('Wrong mail type');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationAcademy extends Mailable
{
    use Queueable, SerializesModels;

    protected $type;
    protected $typeChild;
    protected $userChild;
    protected $userParent;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param $user
     */
    public function __construct($type, $userChild, $userParent, $language_prefix = "en")
    {
        $this->type = $type;
        $this->typeChild = ($type == 'teacher') ? 'students' : 'teacher';
        $this->userChild = $userChild;
        $this->userParent = $userParent;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invitation in list')
            ->view('emails.'.$this->language_prefix.'.user.invitation', [
                'type' => $this->type,
                'typeChild' => $this->typeChild,
                'userChild' => $this->userChild,
                'userParent' => $this->userParent
            ]);
    }
}

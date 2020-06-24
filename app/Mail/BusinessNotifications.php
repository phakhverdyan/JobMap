<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BusinessNotifications extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;
    
    protected $type;
    
    protected $params;

    protected $language_prefix;
    
    /**
     * BusinessNotifications constructor.
     * @param User $user
     * @param $type
     * @param array $params
     */
    public function __construct(User $user, $type, $params = [], $language_prefix = "en")
    {
        $this->user = $user;
        $this->type = $type;
        $this->params = $params;
        $this->language_prefix = $language_prefix;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->type) {
            case 'ACCEPT_INVITE': {
                return $this->subject('New User')->view('emails.'.$this->language_prefix.'.business.accept_invitation', [
                    'user' => $this->user
                ]);
            }
        }
    }
}

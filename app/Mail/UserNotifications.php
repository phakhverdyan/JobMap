<?php

namespace App\Mail;

use App\Business;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserNotifications extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;
    
    protected $type;
    
    protected $params;

    protected $language_prefix;

    /**
     * UserNotifications constructor.
     * @param User $user
     * @param $type
     * @param bool $params
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
            case 'INVITE':
                $business = Business::where('id', '=', $this->params['business_id'])->first();
                $this->params['business_name'] = ($business) ? $business['name'] : '';
                return $this->subject('Business invitation')
                    ->view('emails.'.$this->language_prefix.'.user.business_invitation', [
                        'user' => $this->user,
                        'params' => $this->params
                    ]);
                break;
            case 'ADD_TO_BUSINESS':
                $business = Business::where('id', '=', $this->params['business_id'])->first();
                $this->params['business_name'] = ($business) ? $business['name'] : '';
                return $this->subject('You added to business')
                    ->view('emails.'.$this->language_prefix.'.user.add_to_business', [
                    'user' => $this->user,
                    'params' => $this->params
                ]);
                break;
            case 'REMOVE_FROM_BUSINESS':
                $business = Business::where('id', '=', $this->params['business_id'])->first();
                $this->params['business_name'] = ($business) ? $business['name'] : '';
                return $this->view('emails.'.$this->language_prefix.'.user.remove_from_business', [
                    'user' => $this->user,
                    'params' => $this->params
                ]);
                break;
        }
    }
}

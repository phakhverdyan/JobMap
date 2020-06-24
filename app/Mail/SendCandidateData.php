<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendCandidateData extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $data;
    protected $language_prefix;
    
    /**
     * UserNotifications constructor.
     * @param User $user
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
        $initialize = $this->subject('Candidate Info')
            ->view('emails.'.$this->language_prefix.'.business.send_candidate_data', [
                'data' => $this->data
            ]);
        if(!empty($this->data->attach_file)){
            $resumePath = config('files.widget.resume_path');
            $filePath = sprintf($resumePath,$this->data->id, $this->data->attach_file);
            if(Storage::exists($filePath)){
                $initialize = $initialize->attach(Storage::path($filePath));
            }
        }
        return $initialize;
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AttachmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $filePaths;

    /**
     * Create a new message instance.
     *
     * @param array $details
     * @param array $filePaths
     */
    public function __construct($details, $filePaths)
    {
        $this->details = $details;
        $this->filePaths = $filePaths;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject($this->details['subject'])
                      ->view('emails.attachment',['emailBody'=>$this->details['body']]);
        
        foreach ($this->filePaths as $filePath) {
            $email->attach($filePath, [
            ]);
        }

        return $email;
    }
}

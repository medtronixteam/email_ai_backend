<?php 

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    public function __construct($code)
    {
        $config = [
            'driver' => 'smtp',
            'host' => "server197.web-hosting.com",
            'port' => "465",
            'username' => "support@emailai.world",
            'password' => "usmandevops133@#",
            'encryption' => "SSL",
            'from' => [
                'address' => "support@emailai.world",
                'name' => "Email Ai Suppor",
            ],
        ];
        Config::set('mail', $config);
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Your Verification Code')
                    ->view('emails.verification_code')
                    ->with(['code' => $this->code]);
    }
}

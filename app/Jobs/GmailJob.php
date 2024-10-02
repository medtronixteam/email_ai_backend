<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Google_Client;
use Google_Service_Gmail;
use Google_Service_Gmail_Message;

class GmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $recipient;
    public $subject;
    public $body;
    public $token;
    public $service;
    public $client;

    /**
     * Create a new job instance.
     */
    public function __construct($recipient)
    {
        Log::info("<-------__construct___-------->");
        $this->recipient=$recipient;
        $this->subject='dasdasd';
        $this->body='ua';
        $this->client = new Google_Client();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->setRedirectUri(config('services.google.redirect'));
        $this->client->addScope("https://www.googleapis.com/auth/gmail.send");
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');


        $user=User::find(18);
        $Livetoken=json_decode($user->google_access_token,true)['access_token'];
        $this->client->setAccessToken($Livetoken);
        $this->service = new Google_Service_Gmail($this->client);

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("<-------__handle___-------->");
        $message = new Google_Service_Gmail_Message();
        $rawMessageString = "From: user@gmail.com\r\n";
        $rawMessageString .= "To: {$this->recipient}\r\n";
        $rawMessageString .= "Subject: {$this->subject}\r\n\r\n";
        $rawMessageString .= $this->body;

        $encodedMessage = base64_encode($rawMessageString);
        $encodedMessage = str_replace(['+', '/', '='], ['-', '_', ''], $encodedMessage);
        $message->setRaw($encodedMessage);

        try {
            $this->service->users_messages->send('me', $message);
            Log::info('Hurrah---------------------');
        } catch (\Exception $e) {

            Log::error('Mail failed to send. Error: ' . $e->getMessage());
        }
    }
}

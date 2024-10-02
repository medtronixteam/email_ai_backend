<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Models\UserEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BulkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $emailId;
    public $configId;
    public $emailAddress;
    public $emailBody;
    public $subject;
    /**
     * Create a new job instance.
     */
    public function __construct($emailId,$configId,$emailBody,$subject)
    {
        $this->configId=$configId;
        $this->emailId=$emailId;
        $this->emailBody=$emailBody;
        $this->subject=$subject;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $jobId = $this->job->getJobId();
        Log::info('BulkJob started. Job ID: ' . $jobId);
        Log::info('yes did'.$this->emailId);
        Log::info('____________Sarting________________ ');
        try {
            $emailData = Contact::find($this->emailId);

            if (!$emailData) {
                Log::error('No email data found for ID: ' . $this->emailId);
                return;
            }
            $this->emailAddress = $emailData->email;

            $config = UserEmail::find($this->configId);
            if (!$config) {
                Log::error('No config found for ID: ' . $this->configId);
                return;
            }

             config([
                'mail.mailers.smtp.host' => $config->main_host,
                'mail.mailers.smtp.port' => $config->main_port,
                'mail.mailers.smtp.username' => $config->main_username,
                'mail.mailers.smtp.password' => $config->main_password,
                'mail.mailers.smtp.encryption' => $config->main_encryption,
            ]);

              // Send the email
            Mail::raw($this->emailBody, function ($message) {
                $message->to($this->emailAddress)
                        ->subject($this->subject);
            });

            $emailData->update(['is_sent' => 1, 'is_failed' => 0,'job_id'=>$jobId]);
            Log::info('____________Success________________ ');
            //code...
        } catch (\Throwable $th) {

            $emailData->update(['is_sent' => 0, 'is_failed' => 1,'job_id'=>$jobId,'failed_reason'=>$th->getMessage()]);
            Log::error('Mail failed to send. Error: ' . $th->getMessage());
        }
    }
}

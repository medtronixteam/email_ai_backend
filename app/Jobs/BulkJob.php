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
use App\Mail\AttachmentMail;
use App\Models\Attachment;

class BulkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $emailId;
    public $configId;
    public $emailAddress;
    public $emailBody;
    public $subject;
    public $attachments;
    /**
     * Create a new job instance.
     */
    public function __construct($emailId,$configId,$emailBody,$subject,$attachments)
    {
        $this->configId=$configId;
        $this->emailId=$emailId;
        $this->emailBody=$emailBody;
        $this->subject=$subject;
        $this->attachments=$attachments;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $jobId = $this->job->getJobId();
        if($jobId == ''){
            $jobId=null;
        }
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
                'mail.mailers.smtp.mailer' => $config->main_mailer,
                'mail.mailers.smtp.port' => $config->main_port,
                'mail.mailers.smtp.username' => $config->main_username,
                'mail.mailers.smtp.password' => $config->main_password,
                'mail.mailers.smtp.encryption' => $config->main_encryption,
                'mail.mailers.smtp.from_name' => $config->main_from_name,
                'mail.mailers.smtp.from_address' => $config->main_from_address,
            ]);
 
              // Send the email
            // Mail::raw($this->emailBody, function ($message) {
            //     $message->to($this->emailAddress)
            //             ->subject($this->subject);
            // });

        
            // Send the HTML email
            Log::info('Attachment________________ '.$this->attachments);
                if($this->attachments=="[]" || $this->attachments==null){
                    Mail::send('emails.bulk_email', ['emailBody' => $this->emailBody], function ($message) {
                        $message->to($this->emailAddress)
                                ->subject($this->subject);
                    });
                }else{  
                    $details = [
                        'subject' => $this->subject,
                        'body' => $this->emailBody,
                    ];
                    $filePaths = [];
                    $allAttachments = json_decode($this->attachments, true);
    
                    if (is_array($allAttachments)) {
                        foreach ($allAttachments as $key => $value) {
                            $attachment = Attachment::find($value);
                            if ($attachment) {
                                $filePaths[$key] = storage_path('app/public/attachments/' . $attachment->file_name);
                            }
                        }
                    }
                    Log::info('File paths: ' . json_encode($filePaths));
                    Mail::to($this->emailAddress)->send(new AttachmentMail($details, $filePaths));

                }
         

            $emailData->update(['is_sent' => 1, 'is_failed' => 0,'job_id'=>$jobId]);
            Log::info('____________Success________________ ');
            //code...
        } catch (\Throwable $th) {

            $emailData->update(['is_sent' => 0, 'is_failed' => 1,'job_id'=>$jobId,'failed_reason'=>$th->getMessage()]);
            Log::error('Mail failed to send. Error: ' . $th->getMessage());
        }
    }
}

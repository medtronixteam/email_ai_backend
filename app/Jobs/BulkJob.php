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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use App\Mail\AttachmentMail;
use App\Models\Attachment;
use App\Models\Tracking;

class BulkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $emailId;
    public $configId;
    public $emailAddress;
    public $emailBody;
    public $subject;
    public $attachments;
    public $campaignId;
    /**
     * Create a new job instance.
     */
    public function __construct($emailId,$configId,$emailBody,$subject,$attachments,$campaignId)
    {
        $this->configId=$configId;
        $this->emailId=$emailId;
        $this->emailBody=$emailBody;
        $this->subject=$subject;
        $this->attachments=$attachments;
        $this->campaignId=$campaignId;
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
                 'mail.mailers.smtp.transport' => $config->main_mailer,
                'mail.mailers.smtp.host' => $config->main_host,
                'mail.mailers.smtp.port' => $config->main_port,
                'mail.mailers.smtp.username' => $config->main_username,
                'mail.mailers.smtp.password' => $config->main_password,
                'mail.mailers.smtp.encryption' => $config->main_encryption,
            ]);
 
            $configs = [
                'driver' => 'smtp',
                'host' => $config->main_host,
                'port' => $config->main_port,
                'username' => $config->main_username,
                'password' => $config->main_password,
                'encryption' => $config->main_password,
                'from' => [
                    'address' => $config->main_from_address,
                    'name' => $config->main_from_name,
                ],
            ];
            Config::set('mail', $configs);
              // Send the email
            // Mail::raw($this->emailBody, function ($message) {
            //     $message->to($this->emailAddress)
            //             ->subject($this->subject);
            // });

        
            // Send the HTML email
            $emailRandomId = Str::uuid();
            Tracking::create([
                'email_id' => $emailRandomId,
                'email' =>$this->emailAddress,
                'campaign_id' =>$this->campaignId,
                'user_id' =>$config->user_id,
                'sent_at' => now(),
                
            ]);
            $trackingUrl ="https://admin.emailai.world/track/".$emailRandomId;
            Log::info('Attachment_________a_______ '.$this->attachments);

                if($this->attachments=="[]" || $this->attachments==null){
                    Mail::send('emails.bulk_email', ['emailBody' => $this->emailBody, 'trackingUrl' => $trackingUrl], function ($message) {
                        $message->to($this->emailAddress)
                                ->subject($this->subject);
                    });
                }else{  
                    $details = [
                        'subject' => $this->subject,
                        'body' => $this->emailBody,
                        'trackingUrl' => $trackingUrl,
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
         

            $emailData->update(['is_sent' => 1, 'is_failed' => 0,'failed_reason'=>null]);
            Log::info('____________Success________________ ');
            //code...
        } catch (\Throwable $th) {

            $emailData->update(['is_sent' => 0, 'is_failed' => 1,'failed_reason'=>$th->getMessage()]);
            Log::error('Ops Mail failed to send. Error: ' . $th->getMessage());
        }
    }
}

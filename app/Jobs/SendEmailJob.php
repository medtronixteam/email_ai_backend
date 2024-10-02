<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use App\Models\UserEmail;
use Illuminate\Support\Facades\Log;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $configs_file;
    public $mail;
    public $tries = 3;
    public $emailBody;
    public $toEmail;

    /**
     * Create a new job instance.
     */
    public function __construct($mail, $configs_file, $emailBody)
    {
        Log::info('Constructing job');
        $this->mail = $mail;
        $this->configs_file = $configs_file;
        $this->emailBody = $emailBody;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $emailData = Contact::find($this->mail);

            if (!$emailData) {
                Log::error('No email data found for ID: ' . $this->mail);
                return; // Exit if no email data found
            }

            $this->toEmail = $emailData->email;

            $config = UserEmail::find($this->configs_file);
            if (!$config) {
                Log::error('No config found for ID: ' . $this->configs_file);
                return;
            }

            // Dynamically set the email configuration
            // config([
            //     'mail.mailers.smtp.host' => $config->main_host,
            //     'mail.mailers.smtp.port' => $config->main_port,
            //     'mail.mailers.smtp.username' => $config->main_username,
            //     'mail.mailers.smtp.password' => $config->main_password,
            //     'mail.mailers.smtp.encryption' => $config->main_encryption,
            // ]);

            // Send the email
            // Mail::raw($this->emailBody, function ($message) {
            //     $message->to($this->toEmail)
            //             ->subject('Testing Email');
            // });

            // Update email status if sent successfully
            $emailData->is_sent = 1;
            $emailData->is_failed = 0;
            $emailData->save();

            Log::info('Mail Sent Successfully to ' . $this->toEmail);
        } catch (\Exception $e) {
            Log::error('Mail failed to send. Error: ' . $e->getMessage());

            // Update email status if failed
            if (isset($emailData)) {
                $emailData->is_sent = 0;
                $emailData->is_failed = 1;
                $emailData->save();
            }
        }
    }
}

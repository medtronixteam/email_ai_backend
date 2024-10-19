<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Campaign;
use App\Models\Contact;
use App\Http\Controllers\UserEmailController;
use App\Http\Controllers\GoogleController;
use App\Models\Group;
use Carbon\Carbon;

class SendCampaignEmails extends Command
{
    protected $signature = 'emails:send-campaigns';
    protected $description = 'Send campaign emails based on the campaign time and date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentDateTime = Carbon::now()->setTimezone(config('app.timezone'));

        // Fetch campaigns where campaign_time and campaign_date are greater than the current time and date
        $campaigns = Campaign::where('status','pending')->get();
        Log::info("campaign loop---------------->".$campaigns);

        Log::info("<-------------campaign stating---------------->".$currentDateTime->toDateString().$currentDateTime->toTimeString());
        $emailController = new UserEmailController();
       // $googleController = new GoogleController();

        foreach ($campaigns as $campaign) {
            Log::info("campaign loop---------------->".$campaign->id);
            $currentDateTime = Carbon::now()->setTimezone($campaign->user->timezone);
            if($campaign->campaign_time<=$currentDateTime->toTimeString() && $campaign->campaign_date<=$currentDateTime->toDateString() ){
                $emailController->updateSmtpSettings($campaign->id);
                
            }
            // if($campaign->email_host == 'gmail_auth'){

            //     $googleController->sendGmails($campaign->id);
            // }else{

            // }

        }
        $startedCampaigns = Campaign::where('status','started')->get();
        foreach ($startedCampaigns as $campaign) {
       // $getContact = Group::join('contacts', 'groups.id', '=', 'contacts.group_id')->where('groups.id', $campaign->group_id)->where('contacts.job_id',null);
      //  $CountFailed = Group::join('contacts', 'groups.id', '=', 'contacts.group_id')->where('groups.id', $campaign->group_id)->where('contacts.job_id','!=',null)->where('contacts.is_failed',1)->count();
            $CountFailed=Contact::where('group_id',$campaign->group_id)->where('is_failed',1)->where('job_id','!=',null)->count();
            $getContact=Contact::where('group_id',$campaign->group_id)->where('job_id','=',null);
            if($getContact->count() == 0){
                $campaign->update(['status' => 'completed','failed_reason'=>$CountFailed.' Emails Failed to send']);
                $getContact->update(['job_id' => null]);
            }
        }

        return Command::SUCCESS;
    }
}

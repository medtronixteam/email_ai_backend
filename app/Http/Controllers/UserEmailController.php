<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\UserMails;
use App\Models\UserEmail;
use App\Jobs\SendEmailJob;
use App\Jobs\BulkJob;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Group;
use Validator;
class UserEmailController extends Controller
{

    public function listEmail($type){

        $userEmail= UserEmail::where('mail_type', $type)->where('user_id', auth('sanctum')->id())->first();
        $response=['status'=>"success",'code'=>200,'data'=>$userEmail];
        return response($response,$response['code']);
     }


    public function createEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mail_type' => 'required|in:gmail,email,outlook',
            'main_mailer' => 'required',
            'main_host' => 'required',
            'main_port' => 'required',
            'main_username' => 'required',
            'main_password' => 'required',
            'main_encryption' => 'required',
            'main_from_address' => 'required',
            'main_from_name' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            $response = [
                'message' => $message,
                'status' => 'error',
                'code' => 500
            ];
        } else {
            $userEmail = UserEmail::where('mail_type', $request->mail_type)
                    ->where('user_id', auth('sanctum')->id())
                    ->first();

            if ($userEmail) {
                $userEmail->update([
                    'main_mailer' => $request->main_mailer,
                    'main_host' => $request->main_host,
                    'main_port' => $request->main_port,
                    'main_username' => $request->main_username,
                    'main_password' => $request->main_password,
                    'main_encryption' => $request->main_encryption,
                    'main_from_address' => $request->main_from_address,
                    'main_from_name' => $request->main_from_name,
                ]);
                $response = [
                    'message' => 'Email data has been updated',
                    'status' => 'success',
                    'code' => 200,
                ];
            } else {
                UserEmail::create([
                    'mail_type' => $request->mail_type,
                    'user_id' => auth('sanctum')->id(),
                    'main_mailer' => $request->main_mailer,
                    'main_host' => $request->main_host,
                    'main_port' => $request->main_port,
                    'main_username' => $request->main_username,
                    'main_password' => $request->main_password,
                    'main_encryption' => $request->main_encryption,
                    'main_from_address' => $request->main_from_address,
                    'main_from_name' => $request->main_from_name,
                ]);
                $response = [
                    'message' => 'Email data has been saved',
                    'status' => 'success',
                    'code' => 200,
                ];
            }
        }

        return response($response, $response['code']);
    }
    public function updateSmtpSettings($compainId)
    {
        $compains=Campaign::find($compainId);
        if($compains->email_host=='email' || $compains->email_host=='gmail_password'){
            if($compains->email_host=='email'){
                $config = UserEmail::where('mail_type', 'email')->where('user_id', $compains->user_id);

            }else{
                $config = UserEmail::where('mail_type', 'gmail')->where('user_id', $compains->user_id);

            }


        if($config->count() == 0){
            $compains->update(['status' => 'failed','failed_reason'=>'Please Config your Email First']);
            Log::info("can not find email config");
        }else{
            $configData = $config->first();
            Log::info("<--controller-----email config approved-------->");
            $emails = Group::join('contacts', 'groups.id', '=', 'contacts.group_id')->where('groups.id', $compains->group_id)->where('contacts.is_sent',0);
            if($emails->count() > 0){
                $compains->update(['status' => 'started']);

                    foreach ($emails->get() as $email) {

                        Log::info("Sending Job for email" .$email->email);
                        //SendEmailJob::dispatch($email->id, $configData->id,$compains->message);
                       $jobBulk=BulkJob::dispatch($email->id,$configData->id,$compains->message,$compains->subject,$compains->attachments,$compains->id);

                    }

            }else{
                $compains->update(['status' => 'completed']);
            }

        } //end of count
        }//end of check gmail and email

    }
}

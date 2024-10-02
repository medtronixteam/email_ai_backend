<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserEmailController;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Group;
use App\Models\UserEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class CampaignController extends Controller
{
    public function list()
    {
        $userId = auth('sanctum')->id();
        $Campaign = Campaign::where('user_id', $userId)->latest()->get();


        $response = [
            'status' => "success",
            'code' => 200,
            'data' => $Campaign,
        ];

        return response($response, $response['code']);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'group_id' => 'required',
            'message' => 'required',
            'subject' => 'required|max:50',
            'email_host' => 'required|in:gmail_password,email,gmail_auth',
            'campaign_time' => 'required|date_format:H:i',
            'campaign_date' => 'required|date_format:Y-m-d',
        ]);
        if ($validator->fails()) {

            $response = ['message' => $validator->messages()->first(),
                'status' => 'error', 'code' => 500];

        } else {
            $currentDateTime = Carbon::now();
            $currentStatus = 'pending';
            if ($request->email_host == 'email') {
                $countEmail = UserEmail::where('mail_type', 'email')->where('user_id', auth('sanctum')->id())->count();
                if ($countEmail == 0) {
                    $response = [
                        'message' => 'Sorry ! You did not Setup Email Configuration.',
                        'status' => 'error',
                        'current_status' => $currentStatus,
                        'code' => 500,
                    ];
                    return response($response, $response['code']);
                }
            } elseif ($request->email_host == 'gmail_password') {
                $countEmail = UserEmail::where('mail_type', 'gmail')->where('user_id', auth('sanctum')->id())->count();
                if ($countEmail == 0) {
                    $response = [
                        'message' => 'Sorry ! You did not Setup Gmail App Configuration.',
                        'status' => 'error',
                        'current_status' => $currentStatus,
                        'code' => 500,
                    ];
                    return response($response, $response['code']);
                }
            } elseif ($request->email_host == 'gmail_auth') {
                if (auth('sanctum')->user()->google_access_token == null) {
                    $response = [
                        'message' => 'Sorry ! You did not Setup Gmail Auth Configuration.',
                        'status' => 'error',
                        'current_status' => $currentStatus,
                        'code' => 500,
                    ];
                    return response($response, $response['code']);
                }
            } else {
                $response = [
                    'message' => 'Sorry ! Invalid Host Type.',
                    'status' => 'error',
                    'current_status' => $currentStatus,
                    'code' => 500,
                ];
                return response($response, $response['code']);
            }
            $campaign = Campaign::create([
                'name' => $request->name,
                'group_id' => $request->group_id,
                'campaign_time' => $request->campaign_time,
                'campaign_date' => $request->campaign_date,
                'email_host' => $request->email_host,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'pending',
                'user_id' => auth('sanctum')->id(),
            ]);
            if ($request->campaign_time <= $currentDateTime->toTimeString() && $request->campaign_date <= $currentDateTime->toDateString()) {
                if ($request->email_host == 'gmail_auth') {
                    $googleController = new GoogleController();
                    $googleController->sendGmails($campaign->id);
                }else{
                    $emailController = new UserEmailController();
                    $emailController->updateSmtpSettings($campaign->id);
                }

                $currentStatus = 'starting';
            }

            $response = [
                'message' => 'Campaign has been created',
                'status' => 'success',
                'current_status' => $currentStatus,
                'code' => 200,
            ];
        }
        return response($response, $response['code']);
    }

    public function startStatus($id)
    {
        $campaign = Campaign::find($id);
        if (!$campaign) {
            return response(['message' => 'Campaign not found', 'status' => 'error', 'code' => 404]);
        }
        if ($campaign->status !== 'started') {
            $campaign->status = 'pending';
            $campaign->campaign_time = Carbon::now()->format('H:i:s');
            $campaign->campaign_date = Carbon::now()->format('Y-m-d');
            Contact::where('group_id',$campaign->group_id)->update(['is_sent' => 0]);
            $emailController = new UserEmailController();
            $emailController->updateSmtpSettings($campaign->id);
            $campaign->save();
        }

        return response(['message' => 'Campaign status updated', 'status' => 'success', 'code' => 200]);

    }

    public function stopstatus($id)
    {
        $campaign = Campaign::find($id);

        if (!$campaign) {
            return response(['message' => 'Campaign not found', 'status' => 'error', 'code' => 404]);
        }
        $counter = 0;
        if ($campaign->status == 'started') {
            $campaign->status = 'stopped';

            foreach ($campaign->group->contacts as $key => $contact) {
                $counter++;
                DB::table('jobs')->where('id', $contact->job_id)->delete();
            }

        }
        $campaign->save();
        return response(['message' => 'Campaign has been stopped', 'stopped_mails' => $counter, 'status' => 'success', 'code' => 200]);
    }

public function update(Request $request, $id)
{
    $campaign = Campaign::find($id);

    if (!$campaign) {
        return response(['message' => 'Campaign not found', 'status' => 'error', 'code' => 404]);
    }
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'group_id' => 'required',
        'message' => 'required',
        'subject' => 'required',
        'email_host' => 'required|in:gmail_password,email,gmail_auth',
        'campaign_time' => 'required|date_format:H:i',
        'campaign_date' => 'required|date_format:Y-m-d',
    ]);

    if ($validator->fails()) {
        return response(['message' => $validator->messages()->first(), 'status' => 'error', 'code' => 500]);
    }
    $campaign->name = $request->name;
    $campaign->group_id = $request->group_id;
    $campaign->message = $request->message;
    $campaign->subject = $request->subject;
    $campaign->email_host = $request->email_host;
    $campaign->campaign_time = $request->campaign_time;
    $campaign->campaign_date = $request->campaign_date;
    $campaign->save();

    return response(['message' => 'Campaign has been updated', 'status' => 'success', 'code' => 200]);
}


    public function delete($id)
    {
        $campaign = Campaign::find($id);
        if (!$campaign) {
            return response(['message' => 'Campaign not found', 'status' => 'error', 'code' => 404]);
        }
        if ($campaign->status = 'started') {
            return response(['message' => 'Started campaigns can not be deleted', 'status' => 'error', 'code' => 500]);
        }
        $campaign->delete();
        return response(['message' => 'Campaign has been deleted', 'status' => 'success', 'code' => 200]);
    }

}

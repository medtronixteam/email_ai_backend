<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Campaign;
use App\Models\User;
use App\Models\UserData;
class UserDataController extends Controller
{
    public function getUserSummary()
    {
        $userId=auth('sanctum')->id();
        $totalGroups = Group::where('user_id', $userId)->count();
        $totalContacts = Group::join('contacts','contacts.group_id','groups.id')->where('groups.user_id', $userId)->count();
        $totalCampaigns = Campaign::where('user_id', $userId)->count();
        $pendingCampaigns = Campaign::where('user_id', $userId)->where('status', 'pending')->count();
        $completedCampaigns = Campaign::where('user_id', $userId)->where('status', 'completed')->count();
        $startedCampaigns = Campaign::where('user_id', $userId)->where('status', 'started')->count();


        return response()->json([
            'total_groups' => $totalGroups,
            'total_contacts' => $totalContacts,
            'total_campaigns' => $totalCampaigns,
            'pending_campaigns' => $pendingCampaigns,
            'completed_campaigns' => $completedCampaigns,
            'started_campaigns' => $startedCampaigns,
        ]);
    }

    public function changeTimezone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'timezone' => 'required',
        ]);
        if ($validator->fails()) {

            $response = ['message' => $validator->messages()->first(),
                'status' => 'error', 'code' => 500];

        }else{

            User::find(auth('sanctum')->id())->update(['timezone'=>$request->timezone]);
            $response = [
                'message' => 'Timezone has been changed',
                'status' => 'success',
                'code' => 200,
            ];

        }
        return response($response, $response['code']);
    }
}

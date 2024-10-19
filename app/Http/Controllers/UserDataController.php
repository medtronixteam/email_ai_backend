<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Campaign;
use App\Models\User;
use App\Models\UserData;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        config(['app.timezone' => $request->timezone]);
        date_default_timezone_set($request->timezone);
        $response = [
            'message' => 'Timezone has been changed',
            'status' => 'success',
            'timezone'=>config('app.timezone'),
            'code' => 200,
        ];

    }
    return response($response, $response['code']);
}
public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }
        $user = auth('sanctum')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'Old password does not match'], 500);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json(['message' => 'Password changed successfully'], 200);
    }
}
<<<<<<< HEAD
//
=======
>>>>>>> 2e9b62007faa79e9f7767d8b5885a3364586a3c6

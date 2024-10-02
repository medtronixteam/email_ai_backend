<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Campaign;
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
}

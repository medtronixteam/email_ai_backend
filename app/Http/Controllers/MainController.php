<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }


    public function adminDashboard()
    {
        $totalUsers = User::count();
    return view('admin.dashboard', compact('totalUsers')); // Pass to view
    }


    public function users()
    {
      //  $users=User::where('role','user')->get();
        return view('admin.users.user_list');
    }

        public function view($id)
    {
        $sellers = User::findOrFail($id);
        return view('admin.users.view', compact('sellers'));
    }
    public function disable($userId)
    {
    $user = User::findOrFail($userId);
    $user->status = 0;
    $user->save();

    return redirect()->back()->with('success', 'User disabled successfully.');
    }
    public function enable($userId)
    {
    $user = User::findOrFail($userId);
    $user->status = 1;
    $user->save();

    return redirect()->back()->with('success', 'User disabled successfully.');
    }
    public function reset($resetId) {
        return view('admin.users.resetPassword', ['resetId' => $resetId]);
    }
    public function resetPass(Request $request) {
        $validatedData = $request->validate([
            "new_password" => ['required', 'min:3'],
        ]);

        if ($validatedData) {
            $user = User::find($request->resetId);
            if ($user) {
                $user->update(['password' => Hash::make($validatedData["new_password"])]);
                flashy()->info('Password has been Updated!', '#');
            } else {
                flashy()->error('Invalid User Id', '#');
            }
        }
        return back()->with('error', 'Password has not been Updated!');
    }

    public function showProfile (){
        return view('admin.users.profile');
    }
    public function resetName(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
    ]);

    $user = Auth::user();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->save();
    flashy()->info('Detail has been Updated!', '#');
    return redirect()->back();
}
public function campaignList()
{
    $Campaign= Campaign::get();
    return view('admin.users.campaigns_list',compact('Campaign'));
}
public function show($id)
{
    $Campaign = Campaign::with(['group', 'user'])->findOrFail($id);
    return view('admin.users.view_campaign', compact('Campaign'));
}
// user create
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
    ]);
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('admin.users.list')->with('success', 'User created successfully.');
}


}

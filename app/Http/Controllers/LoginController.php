<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
   public function index(){

        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }
    public function signup(){

        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('signup');
    }


    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
         //    flashy()->success('Login Successfully ...', '#');
            return redirect()->route('dashboard');
        }
       flashy()->error('Invalid Username or Password ', '#');
        return back()->with('error', 'Invalid Username or Password ');
    }


    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'You have been log out!');
    }

     public function resetPassword($key){
        return view('admin.users.resetPassword',['key'=>$key]);
    }
    public function resetPasswordCh(Request $request){
        $validatedData = $request->validate([
            "password" => ['required','confirmed','min:3'],
        ]);

        if($validatedData){
           $User=User::find(base64_decode($request->key));
           if ($User) {
                  $User->update(['password'=>Hash::make($validatedData["password"])]);
                  flashy()->info('Password has been Updated!', '#');
            }else{

                flashy()->error('Invalid User Id', '#');

            }
        }
            return back()->with('error', 'Password has been not Updated!');
    }


}

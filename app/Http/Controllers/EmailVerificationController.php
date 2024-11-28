<?php

namespace App\Http\Controllers;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\EmailVerification;
use App\Models\User;

class EmailVerificationController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid email address','status'=>'error','code'=>400], 400);
        }

        $email = $request->email;
        $code = rand(100000, 999999);
        $expiresAt = Carbon::now()->addSeconds(60);

        EmailVerification::updateOrCreate(
            ['email' => $email],
            ['verification_code' => $code, 'expires_at' => $expiresAt]
        );

        Mail::to($email)->send(new VerificationCodeMail($code));

        return response()->json(['message' => 'Verification code sent','status'=>'success','code'=>200]);
    }

    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid input'], 400);
        }

        $emailVerification = EmailVerification::where('email', $request->email)
            ->where('verification_code', $request->code)
            ->first();

        if (!$emailVerification) {
            return response()->json(['message' => 'Invalid code','status'=>'error','code'=>500], 500);
        }

        if (Carbon::now()->greaterThan($emailVerification->expires_at)) {
            return response()->json(['message' => 'Code has expired','status'=>'error','code'=>500], 500);
        }

        User::where('email', $request->email)->update(['email_verified_at' => now()]);
        $emailVerification->delete();

        return response()->json(['message' => 'Email verified successfully','status'=>'success','code'=>200],200);
    }
}

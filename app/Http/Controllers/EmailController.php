<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Validator;

class EmailController extends Controller
{
    public function list()
    {

        $email = Email::all();
        $response = ['status' => "success", 'code' => 200, 'data' => $email];
        return response($response, $response['code']);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'bio' => 'required',
            'profileUrl' => 'required',
            'profile' => 'required',
            'birthday' => 'required',
            'contactNumber' => 'required',
            'scraped' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();

            $response = [
                'message' => $message, 'status' => 'error', 'code' => 500,
            ];
            return response($response, $response['code']);
        }
        $existingEmail = Email::where('profileUrl', $request->profileUrl)->first();

        if ($existingEmail) {
            $response = [
                'message' => 'Profile URL already exists',
                'status' => 'success',
                'code' => 200,
            ];
            return response($response, $response['code']);
        } else {

            Email::create([
                'email' => $request->email,
                'name' => $request->name,
                'bio' => $request->bio,
                'profileUrl' => $request->profileUrl,
                'profile' => $request->profile,
                'birthday' => $request->birthday,
                'contactNumber' => $request->contactNumber,
                'scraped' => $request->scraped,
                'metaData' => $request->metaData,
            ]);
            $response = [
                'message' => 'Email Data has been created',
                'status' => 'success',
                'code' => 200,
            ];
        }
        return response($response, $response['code']);
    }
    public function checkProfileUrl(Request $request)
    {
        $profileUrl = $request->input('profileUrl');
        $emailData = Email::where('profileUrl', $profileUrl)->first();
        if ($emailData) {
            return response()->json($emailData);
        } else {
            return response()->json([]);
        }
    }

}

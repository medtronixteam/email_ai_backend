<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Validator;

class EmailController extends Controller
{
    public function list()
    {

        $email = Email::where('scraped',0)->latest()->limit(10)->get();
      //  $response = ['status' => "success", 'code' => 200, 'data' => ];
        return response($email, 200);
    }
    public function scrapped()
    {

        $email = Email::select('email','name','bio','contactNumber','profile','metaData')->where('scraped',1)->get();
      //  $response = ['status' => "success", 'code' => 200, 'data' => ];
        return response($email, 200);
    }
    public function bulk(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'data' => 'required',

        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();

            $response = [
                'message' => $message, 'status' => 'error', 'code' => 500,
            ];
            return response($response, $response['code']);
        }
        foreach (json_decode($request->data,true) as $key => $value) {
            Email::updateOrCreate([
                'profileUrl'   => $value['profileUrl'],
            ],[
                'email' => $value['email'],
                'name' => $value['name'],
                'bio' => $value['bio'],
                'profile' => $value['profile'],
                'birthday' => $value['birthday'],
                'contactNumber' => $value['contactNumber'],
                'scraped' => $value['scraped'],
                'metaData' => $value['metaData'],
            ]);
        }

            $response = [
                'message' => 'Email Data has been created',
                'status' => 'success',
                'code' => 200,
            ];

        return response($response, $response['code']);
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'profileUrl' => 'required',

        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();

            $response = [
                'message' => $message, 'status' => 'error', 'code' => 500,
            ];
            return response($response, $response['code']);
        }

        Email::updateOrCreate([
            'profileUrl'   => $request->profileUrl,
        ],[
            'email' => $request->email,
            'name' => $request->name,
            'bio' => $request->bio,
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

        return response($response, $response['code']);
    }
    public function checkProfileUrl(Request $request)
    {
        $profileUrl = $request->input('profileUrl');
        $emailData = Email::where('profileUrl', $profileUrl)->first();
        if ($emailData) {

            return response($emailData, 200);
        } else {
            return response([], 500);
        }
    }

}

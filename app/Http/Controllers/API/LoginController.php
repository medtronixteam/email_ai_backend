<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class LoginController extends Controller
{

public function login(Request $request)
{
    // Validate the incoming request data
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if ($validator->fails()) {

        $messages = $validator->messages()->first();
        return response()->json([
            'message' => $messages,
            'status' => 'error',
            'code' => 400
        ], 400);
    }
    if (Auth::attempt($request->only('email', 'password'))) {
        // Authentication passed
        $user = Auth::user();
        $token = $user->createToken('my-users-token')->plainTextToken;
        unset($user->id);

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => "Login successfully.",
            'status' => 'success',
            'code' => 200
        ], 200);
    } else {
        // Authentication failed
        return response()->json([
            'message' => "Invalid email or password.",
            'status' => 'error',
            'code' => 401
        ], 401);
    }
}
    function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required|max:20',

        ]);
     if ($validator->fails()) {
        $messages = $validator->messages()->first();
        $response = ['message' => $messages,
            'status' => 'error', 'code' => 500];

     }else{

           $user= User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->name,
            ]);
            $token = $user->createToken('my-users-token')->plainTextToken;
            unset($user->id);

            $response = [
                'user' => $user,
                'token' => $token,
                'message'=>"Register  Successfully.",
                'status'=>'success',
                'code'=>200,

            ];
        }
        return response($response, $response['code']);
    }
}

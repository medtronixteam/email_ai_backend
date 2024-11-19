<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        
    $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);
    if ($validator->fails()) {
        $messages = $validator->messages()->first();
        $response = ['message' => $messages,
            'status' => 'error', 'code' => 500];
        return response($response, $response['code']);
    }
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Create a PaymentIntent
        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount, // Amount in cents
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
        } catch (\Throwable $th) {
            $response = ['message' =>"Error while generating payment link",
            'status' => 'error', 'code' => 500];
            return response($response, $response['code']);
        }
    }
}

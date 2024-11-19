<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Validator;
class SubscriptionController extends Controller
{
    public function subscribePlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:plans,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
    
 
        $existingSubscription = Subscription::where('user_id', auth('sanctum')->id())
                                            ->where('plan_id', $request->plan_id)
                                            ->first();
    
        if ($existingSubscription) {
            return response()->json([
                'message' => 'User is already subscribed to this plan.',
            ], 409);
        }
    
        try {
            $subscription = Subscription::create([
                'user_id' =>auth('sanctum')->id(),
                'plan_id' => $request->plan_id,
                'activation_date' => now(),
            ]);
    
            return response()->json([
                'message' => 'Plan subscribed successfully!',
                'subscription' => $subscription,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while subscribing to the plan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}

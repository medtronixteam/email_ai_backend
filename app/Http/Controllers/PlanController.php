<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
class PlanController extends Controller
{
    public function createPlans(Request $request)
    {
        $plans = [
            [
                'plan_name' => 'Free',
                'plan_duration' => 'month',
                'plan_price' => $request->input('free_month_price', 0.00),
            ],
            [
                'plan_name' => 'Pro',
                'plan_duration' => 'month',
                'plan_price' => $request->input('pro_month_price', 9.99),
            ],
            [
                'plan_name' => 'Pro',
                'plan_duration' => 'year',
                'plan_price' => $request->input('pro_year_price', 99.99),
            ],
            [
                'plan_name' => 'Premium',
                'plan_duration' => 'month',
                'plan_price' => $request->input('premium_month_price', 19.99),
            ],
            [
                'plan_name' => 'Premium',
                'plan_duration' => 'year',
                'plan_price' => $request->input('premium_year_price', 199.99),
            ],
        ];

        foreach ($plans as $plan) {
            $existingPlan = Plan::where('plan_name', $plan['plan_name'])
                                ->where('plan_duration', $plan['plan_duration'])
                                ->first();

            if ($existingPlan) {
                $existingPlan->update([
                    'plan_price' => $plan['plan_price']
                ]);
            } else {
                Plan::create($plan);
            }
        }

        return response()->json(['message' => 'Plans created/updated successfully'], 201);
    }


    public function index()
    {
        $plans = Plan::all();
        return response()->json($plans);
    }
}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\UserEmailController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TicketController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// authentication
Route::post('auth/login', [LoginController::class, 'login']);
Route::post('auth/register', [LoginController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {

// groups
Route::get('groups', [GroupController::class, 'list']);
Route::post('groups', [GroupController::class, 'store']);
Route::delete('groups/{id}', [GroupController::class, 'delete']);

// contacts
Route::post('contacts',[ContactController::class,'createContact']);
Route::get('contacts',[ContactController::class,'listContact']);
Route::delete('contacts/{id}',[ContactController::class, 'delete']);

// campaign
Route::post('campaign', [CampaignController::class, 'store']);
Route::get('campaign',[CampaignController::class,'list']);
Route::post('campaign/{id}', [CampaignController::class, 'update']);
Route::delete('campaign/{id}', [CampaignController::class, 'delete']);
Route::get('campaign/{id}/start', [CampaignController::class, 'startStatus']);
Route::get('campaign/{id}/stop', [CampaignController::class, 'stopStatus']);

// Users
Route::post('addusers', [AddUserController::class, 'createUser']);
Route::get('addusers/{group}', [AddUserController::class, 'listUser']);
Route::delete('addusers/{id}', [AddUserController::class, 'delete']);

// email
Route::post('email', [UserEmailController::class, 'createEmail']);
Route::get('email/{type}', [UserEmailController::class, 'listEmail']);

//google auth
Route::get('/auth/google', [GoogleController::class, 'generateUrl']);


// user data
Route::get('dashboard', [UserDataController::class, 'getUserSummary']);
Route::post('change-password', [UserDataController::class, 'changePassword']);
Route::post('timezone', [UserDataController::class, 'changeTimezone']);


Route::get('/tickets', [TicketController::class, 'list']);
Route::post('/tickets', [TicketController::class, 'store']);
Route::get('/tickets/{id}', [TicketController::class, 'listById']);


//atachment

Route::post('/attachments', [AttachmentController::class, 'upload']);
Route::get('/attachments', [AttachmentController::class, 'list']);

//plans
Route::get('/plans', [PlanController::class, 'index']);
Route::post('/plans', [PlanController::class, 'createPlans']);
});

Route::middleware('throttle:60,1')->group(function () {
    Route::post('emails', [EmailController::class, 'store']);
    Route::post('emails/bulk', [EmailController::class, 'bulk']);
    Route::get('emails',[EmailController::class,'list']);
    Route::get('emails/scrapped',[EmailController::class,'scrapped']);
    Route::post('profile-url', [EmailController::class, 'checkProfileUrl']);
});


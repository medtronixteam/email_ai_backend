<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TempletController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('home');


// Route::get('signup', [LoginController::class, 'signup'])->name('signup');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('login', [LoginController::class, 'authenticate'])->name('loginPost');
Route::get('reset-password/{key}', [LoginController::class, 'resetPassword'])->name('reset.password');
Route::post('reset-password', [LoginController::class, 'resetPasswordCh'])->name('reset.password.post');
Route::group(
    [ 'middleware' => ['auth'], 'prefix' => 'admin'],
    function () {

Route::get('dashboard', [MainController::class, 'adminDashboard'])->name('dashboard');
Route::post('users', [MainController::class, 'store'])->name('admin.users.store');
Route::get('users/list', [MainController::class, 'users'])->name('admin.users.list');
Route::get('/users/view/{id}', [MainController::class, 'view'])->name('admin.users.view');
Route::post('users/disable/{userId}', [MainController::class, 'disable'])->name('admin.users.disable');
Route::post('users/enable/{userId}', [MainController::class, 'enable'])->name('admin.users.enable');
Route::get('user/reset-password/{id}', [MainController::class, 'reset'])->name('user.reset');
Route::post('user/reset-pass', [MainController::class, 'resetPass'])->name('reset.password');
Route::get('/profile', [MainController::class, 'showProfile'])->name('profile');
Route::post('profile/reset-name', [MainController::class, 'resetName'])->name('profile.reset.name');

Route::get('camapign/list', [MainController::class, 'campaignList'])->name('admin.users.campaigns_list');
Route::get('campaign/{id}', [MainController::class, 'show'])->name('campaign.show');

Route::get('ticket/list', [MainController::class, 'ticketList'])->name('admin.users.tickets');
Route::get('ticket/message/{ticketId}', [MainController::class, 'ticketmessage'])->name('admin.ticket.message');
Route::post('ticket/reply/{messageId}', [MainController::class, 'ticketreply'])->name('admin.support.reply');
Route::get('ticket/support', [MainController::class, 'support'])->name('admin.users.reply');
Route::post('ticket/closed/{ticketId}', [MainController::class, 'ticketclose'])->name('admin.tickets.close');
Route::post('ticket/open/{ticketId}', [MainController::class, 'ticketopen'])->name('admin.tickets.open');

Route::get('templets', [TempletController::class, 'templets'])->name('admin.users.templets');
Route::post('templets/store', [TempletController::class, 'store'])->name('admin.users.templetstore');
Route::get('edittemplete/{id}', [TempletController::class, 'edit'])->name('admin.users.templetedit');
Route::post('templetupdate/{id}', [TempletController::class, 'update'])->name('admin.users.templetupdate');
Route::post('/admin/template/delete/{templateId}', [TempletController::class, 'delete'])->name('admin.users.delete');
});
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('auth/redirect/google', [GoogleController::class, 'redirectToGoogle']);

Route::get('/track/{emailId}', [App\Http\Controllers\TrackingController::class, 'track'])->name('email.track');
Route::get('/template/{temId}', [App\Http\Controllers\TrackingController::class, 'renderTemp'])->name('email.temp');
Route::get('template/{token}/{temId}', [App\Http\Controllers\TrackingController::class, 'Temp'])->name('render.temp');



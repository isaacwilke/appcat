<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WebcamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [LoginController::class,'Display'])->name('login');

Route::get('/whisker-login',[LoginController::class,'show'])->name('login');

Route::get('/register',[RegisterController::class,'create'])->name('register');
   
Route::post('/register',[RegisterController::class,'store'])->name('register.performed');
Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');
Route::get('/griffin-dashboard/{status?}',[HomeController::class,'index1'])->name('home');
Route::post('logout',[LoginController::class,'logout'])->name('logout');

Route::post('api/update', [LoginController::class, 'updateapi'])->name('api.performed');
Route::post('/whisker-login',[LoginController::class,'login'])->name('login.performed');
Route::get('/griffin-login', [LoginController::class,'Display'])->name('griffin');
Route::post('login-griffin', [LoginController::class,"store"])->name('login.griffin');
Route::get('/demo',[LoginController::class,'demo']);
Route::get('/demo1',[LoginController::class,'demo1']);
Route::get('/whisker/profile',[LoginController::class,'getProfile'])->name('profile');
Route::post('/whisker/update/profile', [LoginController::class,"updateProfile"])->name('update');
Route::get('/griffin-profile',[LoginController::class,'getGriffinProfile'])->name('griffin-profile');
Route::post('griffin/update/profile', [LoginController::class,"updateGriffinProfile"])->name('update-griffin-profile');
Route::get('griffin' , [LoginController::class, "switchToGriffin"])->name('switch');
Route::get('whisker' , [LoginController::class, "switchToWhisker"])->name('switch.whisker');

Route::get('griffin-billing',[BillingController::class,'griffinBilling'])->name('griffin-billing');
Route::post('grifin-update-profile',[BillingController::class, 'storeGriffinBilling'])->name('billing.stored');
Route::get('whisker-billing',[BillingController::class,'whiskerBilling'])->name('whisker-billing');
Route::post('whisker-update-profile',[BillingController::class, 'storeWhiskerBilling'])->name('whisker.stored');

Route::get('griffin-reset-password',[ResetPasswordController::class,'griffinReset'])->name('griffin.reset');
Route::get('whisker-reset-password',[ResetPasswordController::class,'whiskerReset'])->name('whisker.reset');
Route::post('griffin-password',[ResetPasswordController::class,'griffinPassword'])->name('griffin.password');
Route::post('whisker-set-password',[ResetPasswordController::class,'whiskerPassword'])->name('whisker.password');
Route::get('grffin-set-password',[ChangePasswordController::class,'griffinDisplayPassword'])->name('griffin.set');
Route::post('grffin-password',[ChangePasswordController::class,'griffinSetPassword'])->name('griffin.postpassword');
Route::get('whisker-set-password',[ChangePasswordController::class,'whiskerDisplayPassword'])->name('whisker.set');
Route::post('whisker-password',[ChangePasswordController::class,'whiskerSetPassword'])->name('whisker.postpassword');
Route::get('whisker-change-password',[LoginController::class,'whiskerchangepassword'])->name('changepassword');
Route::get('griffin-change-password',[LoginController::class,'griffinchangepassword'])->name('changepassword1');

Route::post('griffin-password-change',[LoginController::class,'griffinpasswordchange'])->name('update-griffin-password');
Route::post('whisker-password-change',[LoginController::class,'whiskerpasswordchange'])->name('update-whisker-password');
Route::get('logout',[LoginController::class,'logout'])->name('logout');

Route::get('whisker-orders',[OrderController::class,'getWhiskerOrder'])->name('whisker.order');
Route::get('whisker-orders/{id}',[OrderController::class,'editWhiskerOrder'])->name('whisker.edit');
Route::post('whisker-order-store',[OrderController::class,'storeWhskerOrder'])->name('whisker.orderstore');

Route::get('griffin-orders',[OrderController::class,'getGriffinOrder'])->name('griffin.order');
Route::get('griffin-orders/{id}',[OrderController::class,'editGriffinOrder'])->name('griffin.edit');
Route::post('griffin-order-store',[OrderController::class,'storeGriffinOrder'])->name('griffin.orderstore');

Route::get('whisker-membership', [MembershipController::class,'getMember'])->name('whisker.member');

Route::get('whisker-transaction',[TransactionController::class,'getWhiskerTransaction'])->name('whisker.transaction');

Route::get('whisker-memberships-list',[MembershipController::class,'listMembership'])->name('whisker.memberlist');

Route::get('whisker-membership_details/{id}',[MembershipController::class,'membershipdetails'])->name('whisker.memberlist.detail');
Route::get('whisker-membership-purchase/{id}',[MembershipController::class,'addmember'])->name('whisker.addmember');
Route::get('whisker-transaction-pdf/{id}',[TransactionController::class,'viewTransaction'])->name('whisker.transactionpdf');

Route::get('griffin-dashboard/bookings/{id}',[HomeController::class, 'griffinbooking'])->name('griffin.bookingsview');
Route::get('griffin-contactus',[HomeController::class, 'contactus'])->name('griffin.contactus');
Route::post('griffin-sendcontact',[HomeController::class,'sendContactus'])->name('griffin.sendcontact');

Route::post('griffin_cancel_reservation',[HomeController::class,"cancelReservation"])->name('griffin.cancel');

Route::get('griffin-webcam',[WebcamController::class,"griffinwebcam"])->name('griffin.webcam');


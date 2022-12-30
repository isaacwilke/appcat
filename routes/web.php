<?php

use App\Http\Controllers\BillingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ChangePasswordController;

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

Route::get('/', [LoginController::class,'show'])->name('login');

Route::get('/whisker-login',[LoginController::class,'show'])->name('login');

Route::get('/register',[RegisterController::class,'create'])->name('register');
   
Route::post('/register',[RegisterController::class,'store'])->name('register.performed');
Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');
Route::get('/griffin-dashboard',[HomeController::class,'index1'])->name('home');
Route::post('logout',[LoginController::class,'logout'])->name('logout');
Route::get('reset-password',[ResetPasswordController::class,'show'])->name('reset.password');
Route::post('forget-password', [ResetPasswordController::class,'send'])->name('reset.performed'); 
Route::get('reset-password/{token}/{email}', [ChangePasswordController::class, 'show'])->name('reset.password.get');
Route::post('password', [ChangePasswordController::class, 'update'])->name('reset.password.post');
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
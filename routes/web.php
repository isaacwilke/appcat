<?php

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
Route::get('/login',[LoginController::class,'show'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.performed');
Route::get('/register',[RegisterController::class,'create'])->name('register');
   
Route::post('/register',[RegisterController::class,'store'])->name('register.performed');
Route::get('dashboard',[HomeController::class,'index'])->name('home');
Route::get('/login/api',[LoginController::class,'api'])->name('api');
Route::post('logout',[LoginController::class,'logout'])->name('logout');
Route::get('reset-password',[ResetPasswordController::class,'show'])->name('reset.password');
Route::post('forget-password', [ResetPasswordController::class,'send'])->name('reset.performed'); 
Route::get('reset-password/{token}', [ChangePasswordController::class, 'show'])->name('reset.password.get');
Route::post('reset-password', [ChangePasswordController::class, 'update'])->name('reset.password.post');
Route::post('api/update', [LoginController::class, 'updateapi'])->name('api.performed');

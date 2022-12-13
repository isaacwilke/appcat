<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',[LoginController::class,'show'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.performed');
Route::get('/register',[RegisterController::class,'create'])->name('register');
   
Route::post('/register',[RegisterController::class,'store'])->name('register.performed');
Route::get('dashboard',[HomeController::class,'index'])->name('home');

Route::post('logout',[LoginController::class,'logout'])->name('logout');
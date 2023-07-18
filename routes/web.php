<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::middleware(['guest'])->group(function (){
    Route::get('/login', [HomeController::class, 'login'])->name('login');
    Route::post('/login', [HomeController::class, 'postLogin']);
    Route::get('/register', [HomeController::class, 'register']);
    Route::post('/register', [HomeController::class, 'postRegister'])->name('register');
    Route::get('/forgot-password', [HomeController::class, 'forgetPassword']);
    Route::post('/forgot-password', [HomeController::class, 'postForgetPassword']);

    Route::get('/reset-password/{token}', [HomeController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password/{token}', [HomeController::class, 'postResetPassword']);
});

// verified email
Route::prefix('email')->group(function (){
    Route::get('/verify/need-verification', [VerificationController::class, 'notice'])->middleware(['auth'])->name('verification.notice');
    Route::get('/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
});

// Dashboard
Route::middleware(['auth', 'verified'])->group(function (){

});
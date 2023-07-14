<?php

use App\Http\Controllers\HomeController;
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


Route::get('/login', [HomeController::class, 'login'])->name('Login');
Route::get('/register', [HomeController::class, 'register'])->name('Register');
Route::get('/forgot-password', [HomeController::class, 'forgetPassword'])->name('Forget-password');
Route::get('/forgot', [HomeController::class, 'doneEmailVerified']);

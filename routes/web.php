<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
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

Route::get('/activity', [ActivityController::class, 'list']);
Route::get('/news', [NewsController::class, 'list']);
Route::get('/news/{slug}', [NewsController::class, 'details']);

// Dashboard
Route::middleware(['auth', 'verified'])->group(function (){
    Route::prefix('/dashboard')->group(function (){
        Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

        // news route
        Route::prefix('/news')->group(function (){
            Route::get('/', [NewsController::class, 'list'])->name('news.list');
            Route::get('/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('/create', [NewsController::class, 'postCreate'])->name('news.postCreate');
            Route::get('/update/{slug}', [NewsController::class, 'update'])->name('news.update');
            Route::post('/update/{slug}', [NewsController::class, 'postUpdate'])->name('news.postUpdate');
            Route::get('/delete/{slug}', [NewsController::class, 'delete'])->name('news.delete');
        });

        //ckeditor image upload
        Route::post('/ckeditor-upload', [CKEditorController::class, 'uploadNews'])->name('ckeditor.uploadNews');
    });
});
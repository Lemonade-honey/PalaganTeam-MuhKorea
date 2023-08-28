<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MassageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

// news
Route::get('/news', [NewsController::class, 'listPublic']);
Route::get('/news/search', [NewsController::class, 'listPublicSearch'])->name('newsPublicSearch');
Route::get('/news/{slug}', [NewsController::class, 'details'])->name('newsPublic');

// geteway massage
Route::post('/massage/{id}/{slug}', [MassageController::class, 'store'])->name('massage.store');
Route::post('/massage/reply/{id}/{slug}/{kode}', [MassageController::class, 'storeReply'])->name('massage.storeReply');
Route::get('/massage/{id}/{slug}/{kode}', [MassageController::class, 'delete'])->name('massage.delete');
Route::get('/massage/{id}/{slug}/{kode}/{replyKode}', [MassageController::class, 'deleteReply'])->name('massage.deleteReply');


Route::middleware(['guest'])->group(function () {
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
Route::prefix('email')->group(function () {
    Route::get('/verify/need-verification', [VerificationController::class, 'notice'])->middleware(['auth'])->name('verification.notice');
    Route::get('/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
});

// Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.home');

        // form route
        Route::prefix('/form')->group(function (){

            // private access
            Route::middleware(['role:staf,admin'])->group(function (){
                Route::get('/', [FormController::class, 'list'])->name('form.list');
                Route::get('/create', [FormController::class, 'create'])->name('form.create');
                Route::post('/create', [FormController::class, 'postCreate'])->name('form.postCreate');
                
                Route::get('/{slug}/create', [FormController::class, 'subFormCreate'])->name('form.subForm.create');
                Route::post('/{slug}/create', [FormController::class, 'postSubFormCreate'])->name('subForm.postCreate');

                // delete form
                Route::get('/delete/{slug}', [FormController::class, 'deleteForm'])->name('form.deleteForm');
                Route::get('/delete/{id}/{slug}', [FormController::class, 'deleteSubForm'])->name('subForm.deleteSubForm');

                Route::get('/update/{slug}', [FormController::class, 'update'])->name('form.update');
                Route::post('/update/{slug}', [FormController::class, 'postUpdate'])->name('form.postUpdate');

            });
            
            // public url
            Route::get('/list', [FormController::class, 'listUser'])->name('form.listUser');
            Route::get('/list/search', [FormController::class, 'searchList'])->name('form.listSearch');
            Route::get('/myform', [FormController::class, 'myForms'])->name('form.myForm');
            
            Route::get('/register-user/{slug}', [FormController::class, 'registerUserForm'])->name('form.registerUserForm');
            Route::post('/register-private/{slug}', [FormController::class, 'formPassword'])->name('form.formPassword');
            Route::get('/leave-user/{slug}', [FormController::class, 'leaveUserForm'])->name('form.leaveUserForm');
            
            Route::get('/{slug}', [FormController::class, 'mainForm'])->name('form.mainForm');
            Route::get('/{slug}/member', [FormController::class, 'memberRegister'])->name('form.memberReg');
            Route::get('/{slug}/member/delete/{email}', [FormController::class, 'memberDelete'])->name('form.member.delete');
            Route::get('/{slug}/{sub_slug}', [FormController::class, 'subForm'])->name('form.subForm');
        });

        // staff or admin only
        Route::middleware(['role:staf,admin'])->group(function () {
            // news route
            Route::prefix('/news')->group(function () {
                Route::get('/', [NewsController::class, 'list'])->name('news.list');
                Route::get('/search', [NewsController::class, 'searchDas'])->name('news.searchDas');
                Route::get('/create', [NewsController::class, 'create'])->name('news.create');
                Route::post('/create', [NewsController::class, 'postCreate'])->name('news.postCreate');
                Route::get('/update/{slug}', [NewsController::class, 'update'])->name('news.update');
                Route::post('/update/{slug}', [NewsController::class, 'postUpdate'])->name('news.postUpdate');
                Route::get('/delete/{slug}', [NewsController::class, 'delete'])->name('news.delete');
            });

            // activity route
            Route::prefix('/activity')->group(function () {
                Route::get('/', [ActivityController::class, 'list'])->name('activity.list');
                Route::get('/search', [ActivityController::class, 'search'])->name('activity.search');
                Route::get('/create', [ActivityController::class, 'create'])->name('activity.create');
                Route::post('/create', [ActivityController::class, 'postCreate'])->name('activity.postCreate');
                Route::get('/update/{id}', [ActivityController::class, 'update'])->name('activity.update');
                Route::post('/update/{id}', [ActivityController::class, 'postUpdate'])->name('activity.postUpdate');
                Route::get('/delete/{id}', [ActivityController::class, 'delete'])->name('activity.delete');
            });

            //ckeditor image upload
            Route::post('/ckeditor-upload', [CKEditorController::class, 'uploadNews'])->name('ckeditor.uploadNews');
        });

        // admin only
        Route::middleware(['role:admin'])->group(function () {
            Route::prefix('/users')->group(function () {
                Route::get('/', [UserController::class, 'list'])->name('users.list');
                Route::get('/search', [UserController::class, 'search'])->name('users.search');
                Route::get('/details/{id}', [UserController::class, 'details'])->name('users.details');
                Route::get('/update/{id}', [UserController::class, 'update'])->name('users.update');
                Route::post('/update/{id}', [UserController::class, 'postUpdate'])->name('users.postUpdate');
                Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
            });

            Route::prefix('/sliders')->group(function (){
                Route::get('/', [SliderController::class, 'index'])->name('sliders');
                Route::post('/', [SliderController::class, 'post']);
                Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
            });
        });
    });
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * GET Home Page, Web Profile
     */
    public function index(){
        return view('Home/login-page');
    }

    /**
     * GET Login Page
     */
    public function login(){
        return view('Home/login-page');
    }

    /**
     * POST Login Page
     */
    public function postLogin(Request $request){

    }

    /**
     * GET Register Page
     */
    public function register(){
        return view('Home/register-page');
    }

    /**
     * POST Register Page
     */
    public function postRegister(Request $request){

    }

    /**
     * GET Email Verified Notif Page
     */
    public function notifEmailVerified(){
        return view('Home/email-verif-notif');
    }

    /**
     * GET Email Verified Done Page
     */
    public function doneEmailVerified(){
        return view('Home/email-verif-done');
    }


    /**
     * GET Forget Password Page
     */
    public function forgetPassword(){
        return view('Home/forgot-password');
    }
    
    /**
     * POST Forget Password
     */
    public function postForgetPassword(Request $request){

    }

    /**
     * GET Forget Password Notif
     * 
     * Halamn untuk menampilkan succsess terkirimnya forget password ke email
     */
    public function notifForgetPassword(){
        return view('Home/forgot-password-notif');
    }
    
    /**
     * GET Forget Password Done Update
     * 
     * Halaman setelah selesai update password
     */
    public function doneForgetPassword(){
        return view('Home/forgot-password-done');
    }
}

<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private UserService $userService;
    public function __construct()
    {
        $this->userService = new UserService;
    }

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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try{
            if($this->userService->loginService($request)){
                die('sukses login ' . Auth::user()->role);
            }else{
                return redirect()->back()->withErrors([
                    'error' => 'Email or Password is Wrong'
                ])->withInput();
            }
        }catch (Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
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

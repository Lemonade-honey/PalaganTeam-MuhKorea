<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
    }
    public function index(){
        return view('Dashboard/dashboard');
    }

    public function profile(){
        return dd(auth()->user()->name);
    }
}

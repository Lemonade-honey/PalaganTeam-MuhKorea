<?php

namespace App\Http\Controllers;

use App\Service\ActivityService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private ActivityService $activity;

    public function __construct(){
        $this->middleware(['auth', 'verified']);
        $this->activity = new ActivityService;
    }
    public function index(){
        $activitys = $this->activity->activityWeek();
        return view('Dashboard/dashboard', compact('activitys'));
    }

    public function profile(){
        return dd(auth()->user()->name);
    }
}

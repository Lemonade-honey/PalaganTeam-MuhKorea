<?php

namespace App\Http\Controllers;

use App\Service\ActivityService;
use App\Service\FormService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private ActivityService $activity;
    private FormService $forms;

    public function __construct(){
        $this->middleware(['auth', 'verified']);
        $this->activity = new ActivityService;
        $this->forms = new FormService;
    }
    public function index(){
        $forms = $this->forms->accountFormJoined();
        $activitys = $this->activity->activityWeek();
        
        return view('Dashboard/dashboard', compact('activitys', 'forms'));
    }

    public function profile(){
        return dd(auth()->user()->name);
    }
}

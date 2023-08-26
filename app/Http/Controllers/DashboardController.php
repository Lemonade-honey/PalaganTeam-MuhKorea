<?php

namespace App\Http\Controllers;

use App\Service\ActivityService;
use App\Service\FormService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // admin only
        $totalForm = DB::table('forms')->count();
        $totalUser = DB::table('users')->count();
        
        return view('Dashboard/dashboard', compact('activitys', 'forms', 'totalForm', 'totalUser'));
    }

    public function profile(){
        return dd(auth()->user()->name);
    }
}

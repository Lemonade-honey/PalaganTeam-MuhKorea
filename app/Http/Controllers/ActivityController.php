<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function list(){
        $activity = DB::table('activities')->where('tanggal', '>=', '2023/07/09')
        ->orderByDesc('id')
        ->paginate(10);

        $activity->map(function ($activity){
            $activity->details = unserialize($activity->details);
        });

        return view('Activity/activity-list', compact('activity'));
    }

    /**
     * GET Create Activity Page
     */
    public function create(){
        return view('Activity/activity-create');
    }

    /**
     * POST Create Activity Page
     */
    public function postCreate(Request $request){
        $request->validate([
            'title' => 'required',
            'tanggal' => ['required', 'date', 'after_or_equal:' . date('Y-m-d')],
            'time_start' => ['required', 'date_format:H:i'],
            'time_finish' => ['required', 'date_format:H:i', 'after:time_start'],
            'details' => ['required', 'max:1500']
        ],[
            'time_finish.after' => 'finish time must be greater than start time'
        ]);

        Activity::create([
            'title' => $request->title,
            'tanggal' => date('Y-m-d', strtotime($request->tanggal)),
            'details' => serialize([
                'time-start' => $request->time_start,
                'time-finish' => $request->time_finish,
                'details' => $request->details
            ])
        ]);

        return redirect()->route('activity.list')->with('success', 'Activity Succsess Created');
    }

    /**
     * GET Update Activity Page
     */
    public function update(){

    }

    /**
     * POST Update Activity Page
     */
    public function postUpdate(Request $request){

    }

    /**
     * GET Delete Activity (Only Staff)
     * 
     * Hapus langsung
     */
    public function delete($id){

    }
}

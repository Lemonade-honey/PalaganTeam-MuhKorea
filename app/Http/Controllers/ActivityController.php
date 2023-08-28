<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    /**
     * Display activity
     */
    public function activityDisplay(){
        $activity = DB::table('activities')->where('tanggal', '>=', '2023/07/09')
        ->orderBy('tanggal')
        ->paginate(10);

        return view('Activity/activity-list', compact('activity'));
    }

    /**
     * GET List Activity
     */
    public function list(){
        $activity = DB::table('activities')
        ->orderByDesc('id')
        ->paginate(10);

        return view('activity.activity', compact('activity'));
    }

    /**
     * GET Search Activity
     */
    public function search(Request $request){
        $activity = DB::table('activities')
        ->where("title", "like", "%" .$request->search. "%")
        ->paginate(10);

        return view('activity.activity', compact('activity'));
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
            'details' => ['required']
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
            ]),
            'created_by' => Auth::user()->email
        ]);

        return redirect()->route('activity.list')->with('success', 'Activity Succsess Created');
    }

    /**
     * GET Update Activity Page
     */
    public function update($id){
        $activity = Activity::find($id);

        if(!$activity){
            return redirect()->route('activity.list')->with('errors', 'Activity Not Found');
        }

        $activity->details = unserialize($activity->details);
        return view('Activity/activity-update', compact('activity'));
    }

    /**
     * POST Update Activity Page
     */
    public function postUpdate(Request $request, int $id){
        $request->validate([
            'title' => 'required',
            'tanggal' => ['required', 'date', 'after_or_equal:' . date('Y-m-d')],
            'time_start' => ['required', 'date_format:H:i'],
            'time_finish' => ['required', 'date_format:H:i', 'after:time_start'],
            'details' => ['required']
        ],[
            'time_finish.after' => 'finish time must be greater than start time'
        ]);

        $activity = Activity::find($id);
        if(!$activity){
            return redirect()->route('activity.list')->with('errors', 'Activity Failde to Updated, Activity not found');
        }

        $activity->title = $request->title;
        $activity->tanggal = date('Y-m-d', strtotime($request->tanggal));
        $activity->details = serialize([
            'time-start' => $request->time_start,
            'time-finish' => $request->time_finish,
            'details' => $request->details
        ]);

        $activity->save();
        return redirect()->route('activity.list')->with('success', 'Activity Succsess Updated');
    }

    /**
     * GET Delete Activity (Only Staff)
     * 
     * Hapus langsung
     */
    public function delete($id){
        $activity = Activity::find($id);
        if(!$activity){
            return redirect()->route('activity.list')->with('errors', 'Activity Not Found');
        }

        $activity->delete();
        return redirect()->route('activity.list')->with('success', 'Activity Succsess Deleted');
    }
}

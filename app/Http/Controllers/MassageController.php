<?php

namespace App\Http\Controllers;

use App\Models\Massage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MassageController extends Controller
{

    public function __construct(){
        $this->middleware(['auth', 'verified']);
    }

    public function store( Request $request, int $id, string $slug){
        $massage = Massage::find($id);
        if(!$massage){
            return redirect()->back()->with('errors', 'Failed To Post Massage. Code 001');
        }

        $data = serialize([
            [
                'massage' => $request->massage,
                'by' => Auth::user()->email,
                'time' => date('H:i:s, d F Y', strtotime(now()))
            ]
        ]);

        $history = serialize([
            [
                'post' => Auth::user()->email . " - " . date('H:i:s, d F Y', strtotime(now()))
            ]
        ]);

        $massage->massage_box = $data;
        $massage->massage_history = $history;

        $massage->save();

        return redirect(url()->previous())->with('success', 'Sucses');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index(){
        $slider = DB::table("sliders")
        ->get();

        return view('Slider/slider', compact('slider'));
    }

    public function post(Request $request){
        $request->validate([
            'img' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2024']
        ]);

        $type = $request->file('img')->getClientOriginalExtension();
        $filename = "slider_" . date('dmy') . "_" . Str::random(20) . "." . $type;

        Storage::putFileAs('slider', $request->file('img'), $filename);

        Slider::create([
            'img' => $filename
        ]);

        return redirect()->back()->with('success', 'berhasil ditambahkan');
    }

    public function delete(int $id){
        $slider = Slider::findOrFail($id);

        if(Storage::exists('slider/' . $slider->img)){
            Storage::delete('slider/' . $slider->img);
        }

        $slider->delete();

        return redirect()->back()->with('success', 'berhasil dihapus');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class GalleryController extends Controller
{
    public function index(){
        $gallery = DB::table('galleries')
        ->orderByDesc('id')
        ->get();

        return view('Gallery/index', compact('gallery'));
    }

    public function list(){
        $gallery = DB::table('galleries')
        ->get();

        return view('Gallery/gallery', compact('gallery'));
    }

    public function create(){
        return view('Gallery/create');
    }

    public function post(Request $request){
        $request->validate([
            'img' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4024'],
            'desc' => ['required', 'max:2000']
        ]);

        $type = $request->file('img')->getClientOriginalExtension();
        $filename = "gallery_" . date('dmy') . "_" . date('Hi') . Str::random(20) . "." . $type;
        
        Storage::putFileAs('gallery', $request->file('img'), $filename);

        Gallery::create([
            'img' => $filename,
            'desc' => $request->desc,
            'created_by' => Auth::user()->email
        ]);

        return redirect()->route('gallery.list');
    }

    public function detail($id){
        $gallery = Gallery::findOrFail($id);

        return view('Gallery/detail', compact('gallery'));
    }

    public function update($id, Request $request){
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'desc' => 'required'
        ]);

        try{
            $gallery->desc = $request->desc;
            $gallery->save();

            return redirect()->back()->with('success', 'Desc berhasil diupdate');
        } catch(Throwable $th){
            return redirect()->route('gallery.list')->with('errors', 'gagal update gallert');
        }
    }

    public function delete(int $id){
        $gallery = Gallery::findOrFail($id);

        $gallery->delete();

        return redirect()->route('gallery.list')->with('success', 'berhasil dihapus');
    }
}

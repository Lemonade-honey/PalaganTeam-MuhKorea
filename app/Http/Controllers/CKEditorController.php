<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CKEditorController extends Controller
{
    public function uploadNews(Request $request){
        $type = $request->file('upload')->getClientOriginalExtension();

        $filename = date('dmy') . "_" . Str::random(20) . "." . $type;

        Storage::putFileAs('image/temp', $request->file('upload'), $filename);

        $url = asset('/storage/image/temp/' . $filename);

        return response()->json([
            'filename' => $filename, 
            'uploaded' => 1,
            'url' => $url
        ]);
    }
}

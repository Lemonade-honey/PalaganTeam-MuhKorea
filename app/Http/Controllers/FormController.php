<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Massage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function create(){
        return view('Form/form-create');
    }

    public function postCreate(Request $request){
        $request->validate([
            'title' => ['required', 'max:200', 'unique:forms'],
            'desc' => ['required', 'max:100'],
            'details' => 'required'
        ]);

        if($request->has('form-massage')){
            $massage = Massage::create(['code' => Str::random(25)]);
            $massage = $massage->id;
        }else{
            $massage = null;
        }

        $form = Form::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'desc' => $request->desc,
            'id_massage' => $massage,
            'details' => $request->details
        ]);

        dd($form);
    }
}

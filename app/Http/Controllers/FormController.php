<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Massage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        try{
            DB::beginTransaction();
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
            DB::commit();
            dd($form);
        }catch(Exception $ex){
            DB::rollBack();
        }
    }

    /**
     * GET Public List Form
     */
    public function index(){

    }

    /**
     * GET Public Form Details
     */
    public function details(string $slug){
        if(!DB::table('forms')->where('slug', '=', $slug)->exists()){
            return abort(404);
        }
        $form = DB::table('forms')->select('forms.*', 'massages.massage_box', 'massages.massage_history')
        ->leftJoin('massages', 'forms.id_massage','=', 'massages.id')
        ->where('forms.slug', '=', $slug)->first();
        
        if($form->massage_box != null){
            $form->massage_box = unserialize($form->massage_box);
        }

        return view('Form/public-form-detail', compact('form'));
        // return view('Form/public-form', compact('form'));
    }
}

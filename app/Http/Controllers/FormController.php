<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Massage;
use App\Models\SubForm;
use App\Models\UsersDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'desc' => 'required',
            'status_form' => ['required', 'in:public,private'],
            'password' => 'nullable',
        ]);

        try{
            DB::beginTransaction();
            if($request->massage == 'yes'){
                $massage = Massage::create(['code' => Str::random(25), 'status' => 'aktif']);
                $massage = $massage->id;
            }else{
                $massage = null;
            }

            $form = Form::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'desc' => $request->desc,
                'status' => $request->status_form,
                'img' => $this->randomRGBColor(),
                'categori' => $request->categori ?? null,
                'form' => Str::random(10),
                'password' => $request->password ?? null,
                'id_massage' => $massage,
                'created_by' => Auth::user()->email
            ]);
            DB::commit();
            return redirect()->route('form.mainForm', ['slug' => $form->slug])->with('succsess', 'Form Succsess Created');
        }catch(Exception $ex){
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Random RGB Color
     */
    private function randomRGBColor(){
        function random(){
            return 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ') ';
        }
      
        function derajat(){
            return rand(0, 360) . "deg, ";
        }
        
        function persen(){
            return rand(0, 30) . "%, ";
        }
        
        // linear-gradient(190deg, rgb(129, 168, 50) 0%, rgb(176, 46, 48) 100%)
        return "linear-gradient(" . derajat() . random() . persen() . random() . "100%)";
    }

    /**
     * GET Main Form
     */
    public function mainForm(string $slug){

        $form = DB::table('forms')
        ->select("forms.*", 'massages.massage_box', 'massages.status as status_massage')
        ->leftJoin('massages', 'forms.id_massage', '=', 'massages.id')
        ->where("forms.slug", "=", $slug)->first();

        if(!$form){
            return redirect()->route('form.list')->with('errors', "Form not Found");
        }

        $sub_form = DB::table('sub_forms')
        ->select(["title", "slug", "created_at"])
        ->where("form", "=", $form->form)
        ->get();

        if($form->massage_box != null){
            $form->massage_box = unserialize($form->massage_box);
        }

        // validasi
        if($form->status == 'private' && Auth::user()->role == "user" && Auth::user()->email != $form->created_by){
            if($form->register != null){
                $form->register = unserialize($form->register);
                if(in_array(auth()->user()->email, $form->register)){
                    return view("form.form-main", compact('form', 'sub_form'));
                }
                else{
                    return view('Form/form-password', ['slug' => $slug]);
                }
            }
            return view('Form/form-password', ['slug' => $slug]);
        }else{
            return view("form.form-main", compact('form', 'sub_form'));
        }
    }

    /**
     * Get Sub Form
     */
    public function subForm(string $slug, string $sub_slug){
        $sub_form = DB::table('sub_forms')
        ->select("sub_forms.*", 'massages.massage_box', 'massages.status as status_massage')
        ->leftJoin('massages', 'sub_forms.id_massage', '=', 'massages.id')
        ->where("sub_forms.slug", "=", $sub_slug)
        ->first();

        $form = DB::table("forms")
        ->select(["slug", "status", "register", "created_by"])
        ->where("slug", "=", $slug)
        ->first();

        if($sub_form->massage_box != null){
            $sub_form->massage_box = unserialize($sub_form->massage_box);
        }

        // validasi
        if($form->status == 'private' && Auth::user()->role == "user" && Auth::user()->email != $form->created_by){
            if($form->register != null){
                $form->register = unserialize($form->register);
                if(in_array(auth()->user()->email, $form->register)){
                    return view('form.sub-form', compact('sub_form', 'form'));
                }else{
                    return redirect()->route('form.mainForm', ['slug' => $slug]);
                }
            }
            return redirect()->route('form.mainForm', ['slug' => $slug]);
        }else{
            return view('form.sub-form', compact('sub_form', 'form'));
        }
        
    }

    /**
     * GET My Form
     */
    public function myForms(){
        $user = UsersDetails::findOrFail(Auth::user()->id);
        if($user->form){
            $forms = unserialize($user->form);
            if($forms == null || !is_array($forms)){
                $forms = (object) null;
                return view('form.form-my', compact('forms'));
            }

            $forms = DB::table("forms")
            ->whereIn("slug", $forms)
            ->get();
            
            return view('form.form-my', compact('forms'));
        }

        $forms = (object) null;
        return view('form.form-my', compact('forms'));
    }

    /**
     * GET Created Sub Form
     */
    public function subFormCreate(){
        return view('form.subform-create');
    }

    /**
     * POST Sub Form Create
     */
    public function postSubFormCreate(string $slug, Request $request){
        $request->validate([
            'title' => ['required', 'max:80'],
            'details' => 'required'
        ]);

        try{
            DB::beginTransaction();
            if($request->massage == 'yes'){
                $massage = Massage::create(['code' => Str::random(25), 'status' => 'aktif']);
                $massage = $massage->id;
            }else{
                $massage = null;
            }

            $form = DB::table("forms")
            ->where("slug", "=", $slug)
            ->first();

            $subform = SubForm::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'form' => $form->form,
                'details' => $request->details,
                'id_massage' => $massage,
                'created_by' => Auth::user()->name
            ]);

            DB::commit();

            return redirect()->route('form.mainForm', ['slug' => $slug]);
        } catch(Exception $ex){
            DB::rollBack();


            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * GET List User Form
     */
    public function listUser(){
        $forms = DB::table('forms')->orderByDesc('id')->paginate(6);

        return view('form.form-list', compact('forms'));
    }

    /**
     * GET List Form
     */
    public function list(){
        $form = DB::table('forms')->orderByDesc('id')->paginate(10);

        return view('form.form', compact('form'));
    }

    /**
     * GET Search List Form
     */
    public function searchList(Request $request){
        $forms = DB::table("forms")
        ->where("title", "like", "%". $request->search ."%")
        ->orWhere("created_by", "like", "%". $request->search ."%")
        ->orWhere("categori", "like", "%". $request->search ."%")
        ->paginate(6);

        return view('form.form-list', compact('forms'));
    }

    /**
     * GET Update Form
     */
    public function update(string $slug){
        $form = DB::table('forms')->where('slug', '=', $slug)->first();
        if(!$form){
            return redirect()->route('form.list')->with('errors', 'Form Not Found');
        }
        
        $form->register = unserialize($form->register);
        return view('Form/form-update', compact('form'));
    }

    /**
     * POST Update Form
     */
    public function postUpdate(Request $request, string $slug){
        $request->validate([
            'title' => ['required', 'max:200', 'unique:forms'],
            'desc' => ['required', 'max:100'],
            'status_form' => ['required', 'in:public,private'],
            'password' => 'required',
            'details' => 'required'
        ]);
    }

    /**
     * GET List Member Registerd
     */
    public function memberRegister(string $slug){
        $form = DB::table('forms')->where('slug', '=', $slug)->where('register', '!=', null)->first();
        if(!$form){
            return redirect()->route('form.list')->with('errors', 'Form Not Found');
        }

        $member = unserialize($form->register);
        $slug = $form->slug;
        return view('Form/form-list-member', compact('member', 'slug'));
    }

    public function memberDelete(string $slug, string $email){
        $form = DB::table('forms')->where('slug', '=', $slug)->where('register', '!=', null)->first();
        if(!$form){
            return redirect()->route('form.list')->with('errors', 'Form Not Found');
        }
        try {
            $member = unserialize($form->register);
            foreach($member as $key => $userEmail){
                if($userEmail == $email){
                    unset($member[$key]);
                    break;
                }
            }

            DB::table('forms')->where('slug', '=', $slug)->where('register', '!=', null)->update(['register' => serialize($member)]);
            return redirect()->back()->with('success', "Success Delete Member");
        } catch (Exception $ex) {
            return redirect()->back()->with('errors', "Failed Delete Member. " . $ex->getMessage());
        }
    }

    /**
     * POST Password Form
     */
    public function formPassword(Request $request, string $slug){
        $request->validate([
            'password' => 'required'
        ]);

        $form = DB::table('forms')->where('slug', '=', $slug)->first();
        if($form->password == $request->password){
            if($form->register != null){
                $array = unserialize($form->register);
                array_push($array, auth()->user()->email);
                $register = serialize($array);
            }else{
                $register = serialize([auth()->user()->email]);
            }

            try{
                DB::beginTransaction();
                $form = DB::table('forms')->where('slug', '=', $slug)->update(['register' => $register]);
                $user = UsersDetails::find(Auth::user()->id);

                if($user->form != null){
                    $userForm = unserialize($user->form);
                    array_push($userForm, $slug);

                    $user->form = serialize($userForm);
                }else{
                    $user->form = serialize([$slug]);
                }

                $user->save();

                DB::commit();
                return redirect(url()->previous());
            } catch (Exception $ex){
                DB::rollBack();

                return back()->with('errors', 'Oops Something errors, try again letar. Error :' . $ex->getMessage());
            }
        }else{
            return back()->with('errors', 'password not match');
        }
    }
}

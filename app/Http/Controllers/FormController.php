<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Massage;
use App\Models\SubForm;
use App\Models\User;
use App\Models\UsersDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FormController extends Controller
{
    /**
     * GET List User Form
     */
    public function listUser(){
        $forms = DB::table('forms')->orderByDesc('id')->paginate(6);

        return view('form.form-list', compact('forms'));
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
     * GET List Form
     */
    public function list(){
        $form = DB::table('forms')->orderByDesc('id')->paginate(10);

        return view('form.form', compact('form'));
    }

    /**
     * GET Search List Form
     */
    public function search(){

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
        ->select([ "id", "title", "slug", "created_at"])
        ->where("form", "=", $form->form)
        ->get();

        // massage
        if($form->massage_box != null){
            $form->massage_box = unserialize($form->massage_box);
        }

        if(!$form->register) $form->register = serialize([]); 

        $form->register = unserialize($form->register);
        if(!is_array($form->register)) abort(505, "coruption data");

        // cek register
        (in_array(auth()->user()->email, $form->register) || auth()->user()->role == 'admin' || $form->created_by == auth()->user()->email) ? $btn = false : $btn = true;

        switch ($form->status) {
            case 'public':
                return view("form.form-main", compact('form', 'sub_form', 'btn'));
    
            case 'private':
                if($btn){
                    return view('Form/form-password', ['slug' => $slug]);
                }
                return view("form.form-main", compact('form', 'sub_form', 'btn'));

            default:
                return abort(505, "coruption form");
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
     * GET Update Form
     */
    public function update(string $slug){
        $form = DB::table('forms')
        ->select("forms.*", "massages.status as massage_status")
        ->leftJoin("massages", "massages.id", "=", "forms.id_massage")
        ->where('forms.slug', '=', $slug)->first();
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
        
        $form = DB::table("forms")
        ->where("slug", "=", $slug)
        ->first();

        $request->validate([
            'title' => ['required', 'max:200'],
            'desc' => 'required',
            'status_form' => ['required', 'in:public,private'],
            'password' => 'nullable',
            'categori' => 'nullable'
        ]);

        if($request->status_form == 'private' && $request->password == null){
            return redirect()->back()->withErrors("form set private, password form required");
        }

        try {
            DB::beginTransaction();

            // update massage table
            if($form->id_massage != null && $request->massage == 'no'){
                $massage = Massage::findOrFail($form->id_massage);
                $massage->status = "nonaktif";
                $massage->save();

                $massage = $massage->id;
            }else if($form->id_massage != null && $request->massage == 'yes'){
                $massage = Massage::findOrFail($form->id_massage);
                $massage->status = "aktif";
                $massage->save();

                $massage = $massage->id;
            }

            // create massage table
            if($form->id_massage == null && $request->massage == 'no'){
                $massage = null;
            }else if($form->id_massage == null && $request->massage == 'yes'){
                $massage = Massage::create(['code' => Str::random(25), 'status' => 'aktif']);

                $massage = $massage->id;
            }

            $form = Form::find($form->id);
            $form->title = $request->title;
            $form->desc = $request->desc;
            $form->status = $request->status_form;
            $form->categori = $request->categori ?? null;
            $form->password = $request->password ?? null;
            $form->id_massage = $massage;

            $form->save();
            DB::commit();

            return redirect()->route('form.list')->with("success", "success update form");
        } catch (Exception $ex) {
            DB::rollBack();

            return redirect()->route('form.list')->with("errors", "failed update form, try again later. Error : " . $ex->getMessage());
        }

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
     * GET Delete subform
     */
    public function deleteSubForm(int $id){
        $subForm = SubForm::findOrFail($id);
        $subForm->delete();
        return redirect(url()->previous())->with("success", "berhasil menghapus sub-form");
    }

    /**
     * GET Delete Main Form
     */
    public function deleteForm(string $slug){
        $form = DB::table("forms")
        ->where("slug", "=", $slug)
        ->first();

        if(!$form){
            return redirect()->route('form.list')->with('errors', "Form not Found");
        }

        $form = Form::find($form->id);
        $form->delete();
        return redirect()->route('form.list')->with('success', "Form deleted");
    }

    /**
     * GET List Member Registerd
     */
    public function memberRegister(string $slug){
        $form = DB::table('forms')->where('slug', '=', $slug)->first();
        if(!$form){
            return redirect()->route('form.list')->with('errors', 'Form Not Found');
        }

        $member = (unserialize($form->register)) ? unserialize($form->register) : (object)null;

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
     * GET register user public
     */
    public function registerUserForm(string $slug){
        $form = DB::table('forms')->where('slug', '=', $slug)->first();
        if(!$form){
            return redirect(url()->previous())->with('errors', "form not found");
        }

        try{
            $user = UsersDetails::findOrFail(Auth::user()->id);

            // logic user form
            if($user->form){
                $user->form = unserialize($user->form);
                $userForm = array_unique($user->form);
            }else{
                // set empty array
                $userForm = [];
            }

            DB::beginTransaction();
            if($form->register == null || !$form->register = unserialize($form->register)){
                // kondisi null atau kosongan atau tidak bisa di unserialize
                array_push($userForm, $form->slug);
                $user->form = serialize($userForm);
                $user->save();
                $form = DB::table('forms')->where('slug', '=', $slug)->update(["register" => serialize([Auth::user()->email])]);

                DB::commit();
                // return succses massage
                return redirect(url()->previous())->with("success", "berhasil daftar");
            }else{
                foreach($form->register as $userEmail){
                    if($userEmail == Auth::user()->email){
                        return redirect(url()->previous())->with("success", "Sudah Terdaftar di form ini");
                    }
                }

                // logic daftar daftar
                array_push($userForm, $form->slug);
                $user->form = serialize($userForm);
                $user->save();

                array_push($form->register, Auth::user()->email);
                $form = DB::table('forms')->where('slug', '=', $slug)->update(["register" => serialize($form->register)]);

                DB::commit();
                return redirect(url()->previous())->with("success", "berhasil daftar");
            }
        } catch(Exception $ex){
            DB::rollBack();

            return abort(504, "failed to join this form, try again later. Error : " . $ex->getMessage());
        }
    }

    /**
     * GET Unregister User Form
     */
    public function leaveUserForm(string $slug){
        $form = DB::table('forms')->where('slug', '=', $slug)->first();

        if(!$form){
            return redirect(url()->previous())->with('errors', "form not found");
        }

        try{
            if($form->register == null || !unserialize($form->register)) return redirect('form.myForm');

            $usersEmail = unserialize($form->register);
            foreach($usersEmail as $key => $userEmail){
                if($userEmail == Auth::user()->email){

                    DB::beginTransaction();
                    unset($usersEmail[$key]);

                    // user logic
                    $user = UsersDetails::findOrFail(Auth::user()->id);
                    foreach($forms = unserialize($user->form) as $key => $formsJoined){
                        if($formsJoined == $form->slug){
                            unset($forms[$key]);
                            $user->form = serialize($forms);
                            $user->save();

                            break;
                        }
                    }

                    // save form
                    $form = DB::table('forms')->where('slug', '=', $slug)->update(["register" => serialize($usersEmail)]);

                    DB::commit();
                    return redirect(url()->previous())->with("success", "user sukses meninggalkan form");
                }
            }

            return redirect(url()->previous())->with("success", "user tidak ditemukan di form");
        } catch(Exception $ex){
            DB::rollBack();

            return abort(504, "error server. Error : " . $ex->getMessage());
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

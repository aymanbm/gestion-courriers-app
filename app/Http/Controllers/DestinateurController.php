<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestinateurRequest;
use App\Models\Destinateur;
use Exception;
use Illuminate\Http\Request;

class DestinateurController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->only(["index","show"]);
    }
    public function index (Request $request) {
        try{
        $destinateurs = Destinateur::paginate(50);

        return view("destinateur.index",
        compact('destinateurs'));
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }

    }

    public function show (Destinateur $destinateur) {
        try{
        return view('destinateur.show',
        compact('destinateur'));
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function create () {
        try{
        return view("destinateur.create");
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function store (DestinateurRequest $request) {
        try{
        $formField = $request->validated();
        Destinateur::create($formField);

        return redirect()->route("destinateurs.index")
        ->with("green","لقد تم إضافة صاحب البريد بنجاح");
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function destroy (Destinateur $destinateur) {
        try{
        $destinateur->delete();

        return to_route("destinateurs.index")
        ->with("green","لقد تم حذف صاحب البريد بنجاح");


    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function edit (Destinateur $destinateur) {
        return view("destinateur.edit",compact("destinateur"));
    }

    public function update (DestinateurRequest $request,Destinateur $destinateur) {
    try{
        $formField = $request->validated();

        $destinateur->fill($formField)->save();
        return to_route("destinateurs.index",$destinateur->id)
        ->with("green","لقد تم تعديل صاحب البريد بنجاح");
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }


}

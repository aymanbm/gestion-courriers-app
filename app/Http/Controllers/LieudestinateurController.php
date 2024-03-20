<?php

namespace App\Http\Controllers;

use App\Http\Requests\LieudestinateurRequest;
use App\Models\Lieudestinateur;
use Exception;

class LieudestinateurController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->only(["index","show"]);
    }
    public function index () {
        try{
        $lieudestinateurs = Lieudestinateur::paginate(50);

        return view("lieudestinateur.index",
        compact('lieudestinateurs'));
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }

    }

    public function show (Lieudestinateur $lieudestinateur) {
        try{
        return view('lieudestinateur.show',
        compact('lieudestinateur'));
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function create () {
        try{
        return view("lieudestinateur.create");
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function store (LieudestinateurRequest $request) {
        try{
        $formField = $request->validated();
        Lieudestinateur::create($formField);

        return redirect()->route("lieudestinateurs.index")
        ->with("green","لقد تم إضافة الجهة المعنية بنجاح");
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function destroy (Lieudestinateur $lieudestinateur) {
        try{
        $lieudestinateur->delete();

        return to_route("lieudestinateurs.index")
        ->with("green","لقد تم حذف الجهة المعنية بنجاح");
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function edit (Lieudestinateur $lieudestinateur) {
        try{
        return view("lieudestinateur.edit",compact("lieudestinateur"));
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function update (LieudestinateurRequest $request,Lieudestinateur $lieudestinateur) {
        try{
        $formField = $request->validated();

        $lieudestinateur->fill($formField)->save();
        return to_route("lieudestinateurs.index",$lieudestinateur->id)
        ->with("green","لقد تم تعديل الجهة المعنية بنجاح");
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }
}

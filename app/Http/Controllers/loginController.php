<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    public function show(){
        try{
        return view("login.show");
    }catch(Exception $e){
        return redirect()->back()
            ->with("danger", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function login(Request $request){
try{
        $login = $request->login;
        $password = $request->password;

        $credentials = [
            "username" => $login,
            "password" => $password,
        ];

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return to_route("homepage")
            ->with("success","لقد تم تسجيل الدخول بنجاح".$login.' .');
        }else{
            return back()->withErrors([
                'login' => "إسم المستخدم أو كلمة المرور خطأ",
            ])->onlyInput("login");
        }
    }catch(Exception $e){
        return redirect()->back()
            ->with("danger", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function logout(){
    try{
        Session::flush();
        Auth::logout();
        return to_route('login');
    }catch(Exception $e){
        return redirect()->back()
            ->with("danger", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }
}

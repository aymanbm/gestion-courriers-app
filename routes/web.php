<?php

use App\Http\Controllers\CourrierController;
use App\Http\Controllers\DestinateurController;
use App\Http\Controllers\LieudestinateurController;
use App\Http\Controllers\loginController;
use App\Models\Courrier;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function(){
    $active1 = "active-li";
    $active2 = "";
    $active3 = "";
    $active4 = "";
    $nb_courriers_reçu = Courrier::where("courrier_statue","مستلمة")->count();
    $nb_courriers_envoyer = Courrier::where("courrier_statue","مرسلة")->count();
    $nb_courriers_envoyer_traiter = Courrier::where("courrier_statue","المرسل المعالج")->count();
    $nb_courriers_reçu_traiter = Courrier::where("courrier_statue","المستلم المعالج")->count();

    return view("dashboard",compact("active1",
    "active2","nb_courriers_envoyer_traiter",
    "nb_courriers_reçu_traiter","nb_courriers_reçu"
    ,"nb_courriers_envoyer"
    ,"active3","active4"));
})->name("homepage")->middleware("auth");

Route::middleware("guest")->group(function(){
    Route::get('/login', [loginController::class,"show"])
    ->name("login.show");
    Route::post('/login', [loginController::class,"login"])
    ->name("login");
});

Route::get('/logout', [loginController::class,"logout"])
->name("logout");

Route::resource('courriers',CourrierController::class);

Route::get('/download-image/{filenames}', [CourrierController::class,"download"])->name('image.download');

Route::get("/gestion",function(){
    $active5 = "active-li";
    $active6 = "";
    return view("gestion.gestion",compact(
        "active5","active6"));
})->name("gestion");

Route::resource('destinateurs',DestinateurController::class);
Route::resource('lieudestinateurs',LieudestinateurController::class);

Route::post('/courriers/{id}/appendfiles', [CourrierController::class, 'appendData'])
->name("appendfiles");
Route::get('/courriers/{id}/appendfiles', [CourrierController::class, 'showAppendForm'])
->name('appendform');

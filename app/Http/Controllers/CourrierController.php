<?php

namespace App\Http\Controllers;
use ZipArchive;

use App\Http\Requests\CourrierRequest;
use App\Models\Courrier;
use Exception;
use Illuminate\Http\Request;

class CourrierController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function index (Request $request){
    try{
        $active4 = "";
        $active3 = "";
        $active2 = "";
        $active1 = "";

        $courriers = Courrier::paginate(50);

        $request->session()->put('type', $request->type?$request->type:session("type"));
        $request->session()->put('title', $request->title?$request->title:session("title"));
        $request->session()->put('date', $request->date?$request->date:session("date"));
        $type = $request->session()->get('type');
        $title = $request->session()->get('title');
        $date = $request->session()->get('date');

            if($type === "rapport"){
                $destinateurs = Courrier::paginate(50);
            }else{
                $destinateurs = Courrier::where("courrier_statue",$type)->paginate(50);
            }

        $lieu_destinateur = $request->lieu_destinateur;
        $destinateur = $request->destinateur;
        $date_start = $request->date_start;
        $date_end = $request->date_end;

        if(isset($destinateur) && isset($lieu_destinateur)&& isset($date_start)
        && isset($date_end)){

            $courriers = Courrier::where("courrier_statue",$type)
                                    ->where("destinateur",$destinateur)
                                    ->where("lieu_destinateur",$lieu_destinateur)
                                    ->whereBetween("created_at", [$date_start, $date_end])                                        // ->where("updated_at",$request->date_start)
                                    ->paginate(50);
        }elseif(isset($destinateur)){
            $courriers = Courrier::where("courrier_statue",$type)
                                    ->where("destinateur",$destinateur)
                                    ->paginate(50);
        }elseif(isset($lieu_destinateur)){
            $courriers = Courrier::where("courrier_statue",$type)
                                    ->where("lieu_destinateur",$lieu_destinateur)
                                    ->paginate(50);
        }elseif(isset($date_start) && isset($date_end)){
            $courriers = Courrier::where("courrier_statue",$type)
                                    ->whereBetween("created_at",[$date_start,$date_end])
                                    ->paginate(50);
        }elseif(isset($date_start)){
            $courriers = Courrier::where("courrier_statue",$type)
                                    ->where("created_at",$date_start)
                                    ->paginate(50);
        }elseif(isset($date_start) && isset($destinateur)){
            $courriers = Courrier::where("courrier_statue",$type)
                                    ->where("destinateur",$destinateur)
                                    ->where("created_at",$date_start)
                                    ->paginate(50);
        }elseif(isset($date_start) && isset($lieu_destinateur)){
            $courriers = Courrier::where("courrier_statue",$type)
                                    ->where("lieu_destinateur",$lieu_destinateur)
                                    ->where("created_at",$date_start)
                                    ->paginate(50);
        }elseif(isset($date_start) && isset($lieu_destinateur)&& isset($destinateur)){
            $courriers = Courrier::where("courrier_statue",$type)
                                    ->where("destinateur",$lieu_destinateur)
                                    ->where("lieu_destinateur",$lieu_destinateur)
                                    ->where("created_at",$date_start)
                                    ->paginate(50);
        }
        else{
            $courriers = Courrier::where("courrier_statue",$type)->paginate(50);
        }

        if($type === "مستلمة"){
            $active3 = "active-li";

        }else if($type === "مرسلة"){
            // $courriers = Courrier::where("courrier_statue","مرسلة")->paginate(50);
            $active2 = "active-li";
        }else if($type === "المرسل المعالج"){
            $courriers = Courrier::where("courrier_statue","المرسل المعالج")->paginate(50);
        }else if($type === "المستلم المعالج"){
            $courriers = Courrier::where("courrier_statue","المستلم المعالج")->paginate(50);
        }
        else if($type === "rapport"){
            $active4 = "active-li";
            if(isset($destinateur) && isset($lieu_destinateur)&& isset($date_start)
        && isset($date_end)){

            $courriers = Courrier::where("destinateur",$destinateur)
                                    ->where("lieu_destinateur",$lieu_destinateur)
                                    ->whereBetween("created_at", [$date_start, $date_end])                                        // ->where("updated_at",$request->date_start)
                                    ->paginate(50);
        }elseif(isset($destinateur)){
            $courriers = Courrier::where("destinateur",$destinateur)
                                    ->paginate(50);
        }elseif(isset($lieu_destinateur)){
            $courriers = Courrier::where("lieu_destinateur",$lieu_destinateur)
                                    ->paginate(50);
        }elseif(isset($date_start) && isset($date_end)){
            $courriers = Courrier::whereBetween("created_at",[$date_start,$date_end])
                                    ->paginate(50);
        }elseif(isset($date_start)){
            $courriers = Courrier::where("created_at",$date_start)
                                    ->paginate(50);
        }elseif(isset($date_start) && isset($destinateur)){
            $courriers = Courrier::where("destinateur",$destinateur)
                                    ->where("created_at",$date_start)
                                    ->paginate(50);
        }elseif(isset($date_start) && isset($lieu_destinateur)){
            $courriers = Courrier::where("lieu_destinateur",$lieu_destinateur)
                                    ->where("created_at",$date_start)
                                    ->paginate(50);
        }elseif(isset($date_start) && isset($lieu_destinateur)&& isset($destinateur)){
            $courriers = Courrier::where("destinateur",$lieu_destinateur)
                                    ->where("lieu_destinateur",$lieu_destinateur)
                                    ->where("created_at",$date_start)
                                    ->paginate(50);
        }
        else{
            $courriers = Courrier::paginate(50);
        }
        }

            return view("courrier.index",
        compact("courriers",
        "active2","active1"
        ,"active4","active3"
        ,"type","date",
"title","courriers","destinateurs"));
}catch(Exception $e){
    return redirect()->back()
        ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
}

    }


    public function show (Courrier $courrier) {
try{
        return view('courrier.show',
        compact('courrier'));
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function create () {
try{
        return view("courrier.create");
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function store (CourrierRequest $request) {
        try {

            $formField = $request->validated();
            // $formField['objet'] = $request->input('objet');
            //
            $filePaths = [];
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('courrier', 'public');
                    $filePaths[] = $path;
                }
            }

        // Concatenate file paths into a single string
            $filesString = implode(',', $filePaths);

            // Create new record with file paths
            $courrier = Courrier::create(array_merge($formField, ['files' => $filesString]));

            return redirect()->route("homepage")
            ->with("green","لقد تم إضافة البريد بنجاح");
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function destroy (Courrier $courrier) {
        try {

        $courrier->delete();

        return to_route("courriers.index")
        ->with("green","لقد تم حذف البريد بنجاح");
    }catch(Exception $e){
        return redirect()->back()
            ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
    }
    }

    public function edit (Courrier $courrier) {

        return view("courrier.edit",compact("courrier"));

    }

    public function update (CourrierRequest $request,Courrier $courrier) {
        try{
            $formField = $request->validated();

            if ($request->hasFile('files')) {
                $filePaths = [];
                foreach ($request->file('files') as $file) {
                    $path = $file->store('courrier', 'public');
                    $filePaths[] = $path;
                }
                $filesString = implode(',', $filePaths);
                $formField['files'] = $filesString;
            }

        $courrier->fill($formField)->save();

        return to_route("courriers.edit",$courrier->id)
        ->with("green","Votre courrier a été bien modifier");
}catch(Exception $e){
    return redirect()->back()
        ->with("red", "حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.");
}
    }


    public function download($filenames,Request $request)
    {
        try{
            $fileNames = explode(",", $filenames);
            // Create a temporary zip file
            $zipFileName = $request->name.".zip";
            $zipFilePath = storage_path('app/' . $zipFileName);

            // Create a new zip archive
            $zip = new ZipArchive;
            if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
                // Add each file to the zip archive
                foreach ($fileNames as $fileName) {
                    $filePath = public_path('storage/courrier/' . $fileName);
                    if (file_exists($filePath)) {
                        $zip->addFile($filePath, $fileName);
                    }
                }
                $zip->close();
            }

            // Download the zip file
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        }catch(Exception $e){
            return redirect()->back()
            ->with("red", "حدث خطأ أثناء تحميل الملفات. الرجاء المحاولة مرة أخرى.");

}
        }


        public function appendData(Request $request, $id)
        {
            try{

                $formField = $request->validate([
                    'files' => 'array|max:10',
                    'files.*' => 'max:20044',]
                );
                $courrier = Courrier::find($id);
                if ($request->hasFile('files')) {
                    $filePaths = [];
                    foreach ($request->file('files') as $file) {
                        $path = $file->store('courrier', 'public');
                        $filePaths[] = $path;
                    }
                    $filesString1 = implode(',', $filePaths);
                    $filesString2 = $filesString1 . "," . $courrier->files;
                    $formField['files'] = $filesString2;
                }

                $courrier->fill($formField)->save();

            return to_route("appendform",compact('id'))
            ->with('green', 'لقد تمت إضافة المرفقات بنجاح');
        }catch(Exception $e){
            return redirect()->back()
            ->with("red", "حدث خطأ أثناء تحميل الملفات. الرجاء المحاولة مرة أخرى.");

}
        }

        public function showAppendForm($id){
    return view('courrier.add',compact("id"));
}

}

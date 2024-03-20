@php
        use App\Models\Destinateur;
        use App\Models\Lieudestinateur;
        use App\Models\Status;

        $destinateurs = Destinateur::all();
        $lieudestinateurs = Lieudestinateur::all();
        $status = Status::all();
    @endphp
<x-master title="تعديل البريد "  css="css/dashboard.css" active1="" active2="" active3="" active4="">
    @php
    $uniqueCourrier_statue = $status->unique('statue');
    $uniqueLieuDestinateurs = $lieudestinateurs->unique('adresse');
    $uniqueDestinateurs = $destinateurs->unique('nom');
    $targetValue1 = $courrier->lieu_destinateur;
    $targetValue2 = $courrier->courrier_statue;
    $targetValue3 = $courrier->destinateur;

    $key1 = $uniqueLieuDestinateurs->search(function ($item) use ($targetValue1) {
        return $item->adresse == $targetValue1;
    });

    if ($key1 !== false) {
        $uniqueLieuDestinateurs->forget($key1);
    }
    //2
    $key2 = $uniqueCourrier_statue->search(function ($item) use ($targetValue2) {
        return $item->statue == $targetValue2;
    });

    if ($key2 !== false) {
        $uniqueCourrier_statue->forget($key2);
    }//3
    $key3 = $uniqueDestinateurs->search(function ($item) use ($targetValue3) {
        return $item->nom == $targetValue3;
    });

    if ($key3 !== false) {
        $uniqueDestinateurs->forget($key3);
    }
    @endphp
    <div class="text-xl bg-gradient-to-r from-blue-300 via-blue-600 to-blue-300 p-3 text-white text- font-bold text-center">تعديل البريد</div>
    @if ($errors->any())
        <x-alert type="danger">
            <h6>Errors :</h6>
            @foreach ($errors->all() as $error)
                <ul>
                    <li>{{$error}}</li>
                </ul>
            @endforeach
        </x-alert>
    @endif
    <form action={{route('courriers.update',$courrier->id)}} method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="grid gap-6 m-5 mb-16  md:grid-cols-2">
            <div>
                <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">رقم الارسال</label>
                <input type="text" id="reference" name="reference" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{old("reference",$courrier->reference)}}"  />
            </div>
            <br>
            <div class=" max-w-sm  w-1/2">
                <label for="date_envoyer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تاريخ الارسال</label>
                <div class="relative mt-auto">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input datepicker datepicker-format="yyyy/mm/dd" name="date_envoyer" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value={{old("date_envoyer",$courrier->date_envoyer)}} >
                </div>
            </div>
            <div class=" max-w-sm  w-1/2">
                <label for="date_reçu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تاريخ الاستلام</label>
                <div class="relative mt-auto">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input datepicker datepicker-format="yyyy/mm/dd" name="date_reçu" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value={{old("date_reçu",$courrier->date_reçu)}} >
                </div>
            </div>
            <div class="mb-6 mt-auto">
                <select id="small" name="destinateur" class="!m-0 bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value='{{old("destinateur",$courrier->destinateur)}}' selected>{{old("destinateur",$courrier->destinateur)}}</option>
                    @foreach ($uniqueDestinateurs as $destinateur)
                        <option value="{{$destinateur->nom}}">{{$destinateur->nom}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6 mt-auto">
                <select id="small" name="lieu_destinateur" class="!m-0 bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value='{{old("lieu_destinateur",$courrier->lieu_destinateur)}}' selected>{{old("lieu_destinateur",$courrier->lieu_destinateur)}}</option>
                    @foreach ($uniqueLieuDestinateurs as $lieu)
                        <option value='{{$lieu->adresse}}'>{{$lieu->adresse}}</option>
                    @endforeach
                </select>
            </div>
            <div class=" mt-auto">
                <select id="small" name="courrier_statue" class="!m-0 bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value='{{old("courrier_statue",$courrier->courrier_statue)}}' selected>{{old("courrier_statue",$courrier->courrier_statue)}}</option>
                    @foreach ($uniqueCourrier_statue as $status)
                        <option value='{{$status->statue}}'>{{$status->statue}}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div>
                <label for="objet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الموضوع</label>
                <textarea id="objet" name="objet" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >{{old("objet",$courrier->objet)}}</textarea>
            </div>
            <div>
                <label for="commentaire" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تعليق</label>
                <textarea id="commentaire" name="commentaire" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >{{old("commentaire",$courrier->commentaire)}}</textarea>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="files">مرفقات</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="files" name="files[]" type="file" multiple>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">تعديل</button>
        </div>
</form>
</x-master>

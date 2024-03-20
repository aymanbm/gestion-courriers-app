<link rel="stylesheet" href={{asset("css/profile.css")}}>
<x-master title="Profils Page" css="css/dashboard.css" active1="" active2="" active3="" active4="">
{{-- <img  class="card-img-top" src={{ asset("storage/".$courrier->image) }} alt="image de {{$profile->nom}}" > --}}
<div class="grid gap-6 m-5 mb-16  md:grid-cols-2">
    <div>
        <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">رقم الارسال</label>
        <input type="text" id="reference" name="reference" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value={{$courrier->reference}} @disabled(true) />
    </div>
    @if ($courrier->courrier_statue === "مستلمة" || $courrier->courrier_statue === "المستلم المعالج")
        <div class=" max-w-sm  w-1/2">
            <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تاريخ الاستلام</label>
            <div class="relative max-w-sm mt-auto w-1/2">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                @isset($courrier->date_reçu)
                <input datepicker datepicker-format="yyyy/mm/dd" name="date" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value={{$courrier->date_reçu}} @disabled(true)>
                @else   <input datepicker datepicker-format="yyyy/mm/dd" name="date" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  @disabled(true)>
                @endisset
            </div>
        </div>
    @elseif ($courrier->courrier_statue === "مرسلة" || $courrier->courrier_statue === "المرسل المعالج")
        <div class=" max-w-sm  w-1/2">
            <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تاريخ الارسال</label>
                <div class="relative max-w-sm mt-auto w-1/2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    @isset($courrier->date_envoyer)
                        <input datepicker datepicker-format="yyyy/mm/dd" name="date" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value={{$courrier->date_envoyer}} @disabled(true)>
                    @else   <input datepicker datepicker-format="yyyy/mm/dd" name="date" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  @disabled(true)>
                    @endisset
                </div>
        </div>
    @endif
    <div class=" max-w-sm  w-1/2">
        <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تاريخ التسجيل</label>
        <div class="relative mt-auto">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
            <input datepicker datepicker-format="yyyy/mm/dd" name="date" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value={{$courrier->created_at}} @disabled(true)>
        </div>
    </div>

    <div class="mt-auto">
        <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">صاحب البريد</label>
        <select id="small" name="destinateur" class="!m-0 bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" @disabled(true)>
            <option value="{{$courrier->destinateur}}">{{$courrier->destinateur}}</option>
        </select>
    </div>
    <div class="mb-6 mt-auto">
        <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الجهة المعنية</label>
        <select id="small" name="lieu_destinateur" class="!m-0 bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" @disabled(true)>
            <option value='{{$courrier->lieu_destinateur}}'>{{$courrier->lieu_destinateur}}</option>
        </select>
    </div>
    <div class="mb-6 mt-auto">
        <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">حالة البريد</label>
        <select id="small" name="courrier_statue" class="!m-0 bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" @disabled(true)>
                <option value='{{$courrier->courrier_statue}}'>{{$courrier->courrier_statue}}</option>
        </select>
    </div>

    <div>
        <label for="objet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الموضوع</label>
        <textarea id="objet" name="objet" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" @disabled(true)>{{$courrier->objet}}</textarea>
    </div>
    <div>
        <label for="commentaire" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تعليق</label>
        <textarea id="commentaire" name="commentaire" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" @disabled(true)>{{$courrier->commentaire}}</textarea>
    </div>
    <div class="mb-6">

        @php
            $filenames = str_replace("courrier/", "", $courrier->files);
        @endphp
        @if(!empty($filenames) && isset($filenames))
        <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >مرفقات :</p><br>
        <a href="{{ route('image.download', ['filenames' => $filenames ,'name' => $courrier->reference ]) }}" class="inline-flex items-center justify-center p-2 text-base font-medium text-white rounded-lg bg-blue-600 transition hover:text-white hover:bg-blue-700 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">

            <svg class="w-6 h-6 text-white mt-[-5px] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
            </svg>&nbsp; &nbsp;
            <span class="w-full">تحميل المرفقات</span>
            <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
        @endif

        {{-- <a href="{{ route('image.download', ['filename' => $courrier->files]) }}">Download files</a> --}}
    </div>

</div>
</x-master>


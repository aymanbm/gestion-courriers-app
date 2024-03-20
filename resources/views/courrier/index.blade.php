<x-master :title="session('title')" css="css/table.css" :active1="$active1" :active2="$active2" :active3="$active3" :active4="$active4">
@include('Partials.filter')

@if (session("type") === "مرسلة" || session("type") === "مستلمة"
|| session("type") === "المرسل المعالج" || session("type") === "المستلم المعالج")
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption class="p-5 text-white text-[1.4rem] bg-gradient-to-r from-white to-[#1b59df] bg-white font-semibold text-left rtl:text-right   dark:text-white dark:bg-gray-800">
            {{session("title")}}
        </caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    رقم الارسال
                </th>
                <th scope="col" class="px-6 py-3">
                    {{session("date")}}
                </th>
                <th scope="col" class="px-6 py-3">
                    تاريخ التسجيل
                </th>
                <th scope="col" class="px-6 py-3">
                    صاحب بالبريد
                </th>
                <th scope="col" class="px-6 py-3">
                    الجهة المعنية
                </th>
                <th scope="col" class="px-6 py-3">
                    الموضوع
                </th>
                <th scope="col" class="px-6 py-3">
                    تعليق
                </th>
                <th scope="col" class="px-6 py-3">
                    مرفقات
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @if (count($courriers) === 0)
                <tr align="center" bgcolor="white">
                    <td colspan="9" style="font-size:1.5rem;padding:20px;">لا يوجد بريد</td>
                </tr>
            @else
                @foreach($courriers as $courrier)
                @php
                $filenames = str_replace("courrier/", "", $courrier->files);
                @endphp
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$courrier->id}}
                    </th>
                    <td class="px-6 py-4">
                        {{$courrier->reference}}
                    </td>
                    <td class="px-6 py-4">
                        @if (session("type") === "مستلمة")
                            {{$courrier->date_reçu}}
                        @elseif (session("type") === "مرسلة")
                            {{$courrier->date_envoyer}}
                        @endif

                    </td>
                    <td class="px-6 py-4">
                        {{$courrier->created_at->format("d-m-Y")}}
                    </td>
                    <td class="px-6 py-4">
                        {{$courrier->destinateur}}
                    </td>
                    <td class="px-6 py-4">
                        {{$courrier->lieu_destinateur}}
                    </td>
                    <td class="px-6 py-4">
                        {{Str::limit($courrier->objet,40)}}
                    </td>
                    <td class="px-6 py-4">
                        {{Str::limit($courrier->commentaire,40)}}
                    </td>
                    <td class="px-6 py-4">
                        @if(!empty($filenames) && isset($filenames))

                            <a href="{{ route('image.download', ['filenames' => $filenames ,'name' => $courrier->reference ]) }}" class="inline-flex items-center text-sm justify-center px-2  font-medium text-gray-500 rounded-lg bg-gray-50 transition hover:text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">

                                <svg class="w-6 h-6 text-gray-500 mt-[-1px] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
                                </svg>&nbsp; &nbsp;
                                <span class="w-full">تحميل</span>
                                <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        @else لا يوجد مرفقات
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href={{route('courriers.show',$courrier->id)}} class="hover:underline font-bold text-green-600">أظهر</a>
                        <form action={{route("courriers.edit",$courrier->id)}} method="GET">
                            @csrf
                            <button type="submit" class="outline-none border-none font-medium text-blue-600 dark:text-blue-500 hover:underline" >تعديل</button>
                        </form>
                            @if(auth()->user()->statue === 'admin')
                                <form action={{route("courriers.destroy",$courrier->id)}} method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class=" outline-none border-none font-medium mx-4 text-red-600 dark:text-red-500 hover:underline" >حذف</button>
                                </form>
                            @endif
                    </td>
                </tr>
            @endforeach

            @endif

        </tbody>
    </table>
{{$courriers->links()}}
<div class="text-center " > يوجد {{$courriers->total()}} بريد</div>


</div>
@elseif (session("type") === "rapport")
 <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption class="p-5 text-white text-[1.4rem] bg-gradient-to-r from-white to-[#1b59df] bg-white font-semibold text-left rtl:text-right   dark:text-white dark:bg-gray-800">
            {{session("title")}}
        </caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    رقم الارسال
                </th>
                <th scope="col" class="px-6 py-3">
                    تاريخ الاستلام
                </th>
                <th scope="col" class="px-6 py-3">
                    تاريخ الارسال
                </th>
                <th scope="col" class="px-6 py-3">
                    تاريخ التسجيل
                </th>
                <th scope="col" class="px-6 py-3">
                    المعني بالبريد
                </th>
                <th scope="col" class="px-6 py-3">
                    الجهة المعنية
                </th>
                <th scope="col" class="px-6 py-3">
                    الموضوع
                </th>
                <th scope="col" class="px-6 py-3">
                    تعليق
                </th>
                <th scope="col" class="px-6 py-3">
                    مرفقات
                </th>
                <th scope="col" class="px-6 py-3">
                    وضعية البريد
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @if (count($courriers) === 0)
                <tr align="center" bgcolor="white">
                    <td colspan="11" style="font-size:1.5rem;padding:20px;">لا يوجد بريد</td>
                </tr>
            @else
            @foreach($courriers as $courrier)
                @php
                    $filenames = str_replace("courrier/", "", $courrier->files);

                @endphp
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$courrier->id}}
                    </th>
                    <td class="px-6 py-4">
                        {{$courrier->reference}}
                    </td>
                    <td class="px-6 py-4">
                        {{$courrier->date_reçu}}
                    </td>
                    <td class="px-6 py-4">
                        {{$courrier->date_envoyer}}
                    </td>
                    <td class="px-6 py-4">
                        {{$courrier->created_at->format("d-m-Y")}}
                    </td>
                    <td class="px-6 py-4">
                        {{$courrier->destinateur}}
                    </td>
                    <td class="px-6 py-4">
                        {{Str::limit($courrier->lieu_destinateur,40)}}
                    </td>
                    <td class="px-6 py-4">
                        {{Str::limit($courrier->objet,40)}}
                    </td>
                    <td class="px-6 py-4">
                        {{Str::limit($courrier->commentaire,40)}}
                    </td>
                    <td class="px-6 py-4">
                        @if(!empty($filenames) && isset($filenames))

                            <a href="{{ route('image.download', ['filenames' => $filenames ,'name' => $courrier->reference ]) }}" class="inline-flex items-center text-sm justify-center px-2  font-medium text-gray-500 rounded-lg bg-gray-50 transition hover:text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">

                                <svg class="w-6 h-6 text-gray-500 mt-[-1px] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
                                </svg>&nbsp; &nbsp;
                                <span class="w-full">تحميل</span>
                                <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        @else لا يوجد مرفقات
                        @endif
                    </td>
                    @if ($courrier->courrier_statue === "مستلمة")
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 border border-green-400">{{$courrier->courrier_statue }}</span>
                        </td>
                    @elseif ($courrier->courrier_statue === "مرسلة")
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 border border-blue-400">{{$courrier->courrier_statue }}</span>
                        </td>
                    @elseif ($courrier->courrier_statue === "المرسل المعالج")
                    <td class="px-6 py-4">
                        <span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300 border border-purple-400">{{$courrier->courrier_statue }}</span>
                    </td>
                    @elseif ($courrier->courrier_statue === "المستلم المعالج")
                        <td class="px-6 py-4">
                            <span class="bg-orange-100 text-orange-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300 border border-orange-400">{{$courrier->courrier_statue }}</span>
                        </td>
                    @endif

                    <td class="px-6 py-4 text-right">
                        <a href={{route('courriers.show',$courrier->id)}} class="hover:underline font-bold text-green-600">أظهر</a>
                        <form action={{route("courriers.edit",$courrier->id)}} method="GET">
                            @csrf
                            <button type="submit" class="outline-none border-none font-medium text-blue-600 dark:text-blue-500 hover:underline" >تعديل</button>
                        </form>
                            @if(auth()->user()->statue === 'admin')
                                <form action={{route("courriers.destroy",$courrier->id)}} method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class=" outline-none border-none font-medium mx-4 text-red-600 dark:text-red-500 hover:underline" >حذف</button>
                                </form>
                            @endif
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
    </table>
{{-- <div class="list_courrier"> --}}
    {{$courriers->links()}}
    <div class="text-center " >يوجد {{$courriers->total()}} بريد</div>
{{-- </div> --}}


</div>


@endif
</x-master>

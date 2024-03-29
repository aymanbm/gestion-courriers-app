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
                    حالة البريد
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
                        @if (session("type") === "مرسلة" || session("type") === "مستلمة")
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">في طور المعالجة</span>
                        @elseif(session("type") === "المرسل المعالج" || session("type") === "المستلم المعالج")
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">مكتملة الإجراء</span>
                        @endif
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
                    <td class="px-6 m-12 flex-col align-middle py-4 text-right">
                        <a href={{route('courriers.show',$courrier->id)}} class="hover:underline font-bold text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                              </svg>

                        </a> &nbsp;&nbsp;&nbsp;
                        <form action={{route("courriers.edit",$courrier->id)}} method="GET">
                            @csrf
                            <button type="submit" class="outline-none border-none font-medium text-blue-600 dark:text-blue-500 hover:underline" >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                  </svg>
                            </button>
                        </form>
                            @if(auth()->user()->statue === 'admin')
                                <form action={{route("courriers.destroy",$courrier->id)}} method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class=" outline-none border-none font-medium my-4 text-red-600 dark:text-red-500 hover:underline" >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M12.963 2.286a.75.75 0 0 0-1.071-.136 9.742 9.742 0 0 0-3.539 6.176 7.547 7.547 0 0 1-1.705-1.715.75.75 0 0 0-1.152-.082A9 9 0 1 0 15.68 4.534a7.46 7.46 0 0 1-2.717-2.248ZM15.75 14.25a3.75 3.75 0 1 1-7.313-1.172c.628.465 1.35.81 2.133 1a5.99 5.99 0 0 1 1.925-3.546 3.75 3.75 0 0 1 3.255 3.718Z" clip-rule="evenodd" />
                                          </svg>

                                    </button>
                                </form>

                            @endif
                            <a href={{ route('appendform', ['id' => $courrier->id]) }} class="px-4 hover:underline font-bold text-purple-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M7.5 3.375c0-1.036.84-1.875 1.875-1.875h.375a3.75 3.75 0 0 1 3.75 3.75v1.875C13.5 8.161 14.34 9 15.375 9h1.875A3.75 3.75 0 0 1 21 12.75v3.375C21 17.16 20.16 18 19.125 18h-9.75A1.875 1.875 0 0 1 7.5 16.125V3.375Z" />
                                    <path d="M15 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 17.25 7.5h-1.875A.375.375 0 0 1 15 7.125V5.25ZM4.875 6H6v10.125A3.375 3.375 0 0 0 9.375 19.5H16.5v1.125c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V7.875C3 6.839 3.84 6 4.875 6Z" />
                                  </svg>

                            </a>
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
                    حالة البريد
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
                    <td class="px-6 py-4 ">
                        @if ($courrier->courrier_statue === "مرسلة" || $courrier->courrier_statue === "مستلمة")
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">في طور المعالجة</span>
                        @elseif($courrier->courrier_statue === "المرسل المعالج" || $courrier->courrier_statue === "المستلم المعالج")
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">مكتملة الإجراء</span>
                        @endif
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

                    <td class="px-6 m-12 flex-col align-middle py-4 text-right">
                        <a href={{route('courriers.show',$courrier->id)}} class="hover:underline font-bold text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                              </svg>

                        </a> &nbsp;&nbsp;&nbsp;
                        <form action={{route("courriers.edit",$courrier->id)}} method="GET">
                            @csrf
                            <button type="submit" class="outline-none border-none font-medium text-blue-600 dark:text-blue-500 hover:underline" >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                  </svg>
                            </button>
                        </form>
                            @if(auth()->user()->statue === 'admin')
                                <form action={{route("courriers.destroy",$courrier->id)}} method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class=" outline-none border-none font-medium my-4 text-red-600 dark:text-red-500 hover:underline" >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M12.963 2.286a.75.75 0 0 0-1.071-.136 9.742 9.742 0 0 0-3.539 6.176 7.547 7.547 0 0 1-1.705-1.715.75.75 0 0 0-1.152-.082A9 9 0 1 0 15.68 4.534a7.46 7.46 0 0 1-2.717-2.248ZM15.75 14.25a3.75 3.75 0 1 1-7.313-1.172c.628.465 1.35.81 2.133 1a5.99 5.99 0 0 1 1.925-3.546 3.75 3.75 0 0 1 3.255 3.718Z" clip-rule="evenodd" />
                                          </svg>

                                    </button>
                                </form>

                            @endif
                            <a href={{ route('appendform', ['id' => $courrier->id]) }} class="px-4 hover:underline font-bold text-purple-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M7.5 3.375c0-1.036.84-1.875 1.875-1.875h.375a3.75 3.75 0 0 1 3.75 3.75v1.875C13.5 8.161 14.34 9 15.375 9h1.875A3.75 3.75 0 0 1 21 12.75v3.375C21 17.16 20.16 18 19.125 18h-9.75A1.875 1.875 0 0 1 7.5 16.125V3.375Z" />
                                    <path d="M15 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 17.25 7.5h-1.875A.375.375 0 0 1 15 7.125V5.25ZM4.875 6H6v10.125A3.375 3.375 0 0 0 9.375 19.5H16.5v1.125c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V7.875C3 6.839 3.84 6 4.875 6Z" />
                                  </svg>

                            </a>
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

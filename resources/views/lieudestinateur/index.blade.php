<x-master title="تسيير الجهات المعنية" css="css/gestion.css" active1="" active2="" active3="" active4="">
    <div class="m-5  mb-10">
        <a href={{route("lieudestinateurs.create")}} class="m-5 mb-10 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">إضافة جهة معنية</a>
    </div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-center  mx-auto text-sm  rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-white text-lg uppercase bg-blue-800 dark:bg-gray-700 dark:text-gray-400">
            <tr class="text-center">
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    الجهات المعنية
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
                @foreach($lieudestinateurs as $lieudestinateur)
                <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$lieudestinateur->id}}
                    </th>
                    <td class="px-6 py-4">
                        {{$lieudestinateur->adresse}}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action={{route("lieudestinateurs.edit",$lieudestinateur->id)}} method="GET">
                            @csrf
                            <button type="submit" class="outline-none border-none font-medium text-blue-600 dark:text-blue-500 hover:underline" >تعديل</button>
                        </form>
                            @if(auth()->user()->statue === 'admin')
                                <form action={{route("lieudestinateurs.destroy",$lieudestinateur->id)}} method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class=" outline-none border-none font-medium mx-4 text-red-600 dark:text-red-500 hover:underline" >حذف</button>
                                </form>
                            @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
{{$lieudestinateurs->links()}}

</div>

</x-master>

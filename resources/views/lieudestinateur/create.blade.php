<x-master title="إضافة جهة المعنية"  css="css/gestion.css" active1="" active2="" active3="" active4="">

    <div class="text-xl bg-gradient-to-r from-blue-300 via-blue-600 to-blue-300 p-3 text-white text- font-bold text-center">إضافة الجهة المعنية</div>
    @if ($errors->any())
        <x-alert type="red">
            <h6>الأخطاء :</h6>
            @foreach ($errors->all() as $error)
                <ul>
                    <li>{{$error}}</li>
                </ul>
            @endforeach
        </x-alert>
    @endif
    <form action={{route('lieudestinateurs.store')}} method="POST">
        @csrf
        <div class="grid gap-6 m-5 mb-16  md:grid-cols-2">
            <div>
                <label for="adresse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الجهة المعنية بالبريد</label>
                <textarea id="adresse" name="adresse" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >{{old("adresse")}}</textarea>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">أضف</button>
        </div>

</form>
</x-master>

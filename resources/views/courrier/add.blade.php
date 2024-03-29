<x-master title="تعديل البريد "  css="css/dashboard.css" active1="" active2="" active3="" active4="">
    <h1 class="text-center text-xl font-bold text-blue-900 m-4">إضافة المرفقات</h1>
    <form action={{ route('appendfiles',$id) }} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="files" name="files[]" type="file" multiple>
        </div>

        <button type="submit" class="text-white !w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">أضف</button>
    </form>

</x-master>

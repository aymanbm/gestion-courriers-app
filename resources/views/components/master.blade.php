@props(['title','css',"active1",'active2','active3','active4'])
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{asset("img/logo.svg")}}">
    <title>{{$title}}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    {{-- @vite(['resources/sass/app.scss','resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{$css}}">
</head>
<body>
    @auth
        @include('Partials.nav')

    <main class="h-full">
        <div class="h-full">
            @include('Partials.flashbag')
            {{$slot}}
        </div>
    </main>

    @include('Partials.footer')
    @endauth
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
</body>
</html>

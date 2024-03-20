<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول للنظام</title>
    <link rel="icon" type="image/x-icon" href="{{asset("img/logo.svg")}}">
    <link rel="stylesheet" href="{{asset("css/login.css")}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container-fluid">
        <div class="row">

            <div class="section-right col-sm-6 col-lg-6 col-6 ">
                <div class="img">
                    <img src="{{asset("img/cc.svg")}}" alt="">
                </div>
                <form action={{route('login')}} method="POST">
                    @csrf
                    @include('Partials.flashbag2')
                    @if ($errors->any())
                        <x-alert2 type="danger">
                            @error ('login') {{$message}}
                            @enderror
                        </x-alert2>
                    @endif
                    <div class="mb-3">
                        <label for="username">إسم المستخدم</label><br>
                        <input type="text" name="login" class="form-control" placeholder="إسم المستخدم">
                    </div>
                    <div class="mb-2">
                        <label for="username">كلمة المرور</label><br>
                        <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" name="keep_me_login">
                        <label for="username">حفظ</label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn">تسجيل الدخول</button>
                    </div>

                </form>
            </div>
            <div class="section-left col-sm-6 col-lg-6 col-6">
                <img src="{{asset("img/3.svg")}}" alt="">
                <h3></h3>
            </div>
        </div>
    </div>

</body>
</html>

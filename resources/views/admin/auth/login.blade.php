<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>

    <title>Вход</title>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-4"> <!-- Меньшая ширина формы -->

        {{-- Проверка на наличие сообщения об ошибке --}}
        @if(session('error'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('error') }}
            </div>
        @endif


        <!-- приставка admin. -->
        <form method="post" action="{{ route('admin.login_process') }}">
            @csrf
            <h3 class="text-center mb-4">Вход</h3> <!-- Заголовок формы -->

            <div class="mb-3">
                <label for="inputEmail3" class="form-label">Email</label>
                <input name="email"
                       type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="inputEmail3"
                       placeholder="Введите email"
                       value="{{ old('email') }}">  <!-- Сохраняет введённое значение после ошибки -->
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputPassword3" class="form-label">Пароль</label>
                <input name="password"
                       type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="inputPassword3"
                       placeholder="Введите пароль">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

{{--            <div class="mb-3 form-check">--}}
{{--                <input type="checkbox" class="form-check-input" id="gridCheck1">--}}
{{--                <label class="form-check-label" for="gridCheck1">Запомнить меня</label>--}}
{{--            </div>--}}

            <button type="submit" class="btn btn-primary w-100">Войти</button> <!-- Кнопка на всю ширину -->
        </form>
    </div>
</div>


</body>
</html>



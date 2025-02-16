@extends('layouts.main_layout')

@section('title','Вход')

@section('content')

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-4"> <!-- Меньшая ширина формы -->

            {{-- Проверка на наличие сообщения об ошибке --}}
            @if(session('error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ session('error') }}
                </div>
            @endif


            <form method="post" action="{{ route('login_process') }}">
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


                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">Запомнить меня</label>
                </div>

                <!-- Ссылки -->
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('forgot') }}" class="text-decoration-none">Забыли пароль?</a>
                    <a href="{{ route('register') }}" class="text-decoration-none">Регистрация</a>
                </div>

                <button type="submit" class="btn btn-primary w-100">Войти</button> <!-- Кнопка на всю ширину -->
            </form>
        </div>
    </div>


@endsection

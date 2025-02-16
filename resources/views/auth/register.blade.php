@extends('layouts.main_layout')

@section('title','Регистрация')

@section('content')

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-4">
            <form action="{{ route('register_process') }}" method="post">
                @csrf

                <h3 class="text-center mb-4">Регистрация</h3>

                <!-- Поле Имя -->
                <div class="mb-3">
                    <label for="inputName" class="form-label">Имя</label>
                    <input name="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="inputName"
                           placeholder="Введите имя"
                           value="{{ old('name') }}"
                           required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Поле Email (is-invalid автоматически добавляет красную рамку) -->
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input name="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="inputEmail"
                           placeholder="Введите email"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Поле Пароль -->
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Пароль</label>
                    <input name="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="inputPassword"
                           placeholder="Введите пароль"
                           required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Подтверждение пароля  (password_confirmation только так назвать поле) -->
                <div class="mb-3">
                    <label for="inputConfirmPassword" class="form-label">Подтверждение пароля</label>
                    <input name="password_confirmation" type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           id="inputConfirmPassword"
                           placeholder="Подтвердите пароль"
                           required>
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Ссылка на вход -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('login') }}" class="text-decoration-none">Есть аккаунт?</a>
                </div>

                <button type="submit" class="btn btn-success w-100">Зарегистрироваться</button>
            </form>
        </div>
    </div>

@endsection

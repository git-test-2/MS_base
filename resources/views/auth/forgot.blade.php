@extends('layouts.main_layout')

@section('title','Восстановление пароля')

@section('content')

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-4">Восстановление пароля</h2>

            {{-- Проверка на наличие сообщения об успехе --}}
            @if(session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('forgot_process') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" placeholder="Введите ваш email"
                           class="form-control @error('email') is-invalid @enderror" required autofocus>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('login') }}" class="btn btn-secondary">Вспомнил пароль</a>
                    <button type="submit" class="btn btn-primary">Восстановить</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@extends('layouts.main_layout')

@section('title','Личный кабинет')

@section('content')

    <div class="container">
        <h2>Личный кабинет</h2>

        {{-- Вывод сообщений --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Форма редактирования --}}
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Новый пароль</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Подтвердите пароль</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Аватар</label>
                <p>Загрузите файл со своего устройства. Нужно квадратное изображение размером хотя бы 184 на 184 пикселя.</p>
                <input type="file" name="avatar" class="form-control">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" width="100" class="mt-2">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>

        {{-- Кнопка удаления аккаунта --}}
        <form action="{{ route('profile.destroy') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить аккаунт?')">Удалить аккаунт</button>
        </form>
    </div

@endsection

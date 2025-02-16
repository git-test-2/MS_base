@extends('layouts.main_layout')

@section('title','Главная')

@section('content')

    @if(session('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4"> <!-- container центрирует контент. mt-4 (margin-top: 4) — добавляет отступ сверху. -->
        <div class="row"> <!-- Создаёт строку Bootstrap (нужно для сетки). -->
            <div class="col-md-8 offset-md-2"> <!-- col-md-8 — занимает 8 из 12 колонок (ширина контента). offset-md-2 — сдвигает блок на 2 колонки (центрирует его). -->
                <div class="card shadow-sm"> <!-- card — карточка Bootstrap (создаёт стильный блок). shadow-sm — небольшой теневой эффект -->
                    <div class="card-body"> <!-- -->
                        <h4 class="text-center">Добро пожаловать на сайт MS!</h4>
                        <p class="text-muted text-center"> <!-- p.text-muted (делает текст немного светлее). -->
                            Тут вы сможете найти интересные цитаты и афоризмы.
                            В будущем планируется добавить картинки и не только.
                            Заходите, будет интересно!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

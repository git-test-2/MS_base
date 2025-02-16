@extends('layouts.admin_layout')

@section('title','Добавить цитату')

@section('content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">

                <form action="{{ route('admin.quotes.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="quote" class="form-label">Цитата</label>
                        <textarea class="form-control" id="quote" rows="3" name="quote"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Автор</label>
                        <input type="text" class="form-control" id="author" name="author"> <!-- placeholder="name@example.com" -->
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Дата цитаты</label>
                        <input type="text" class="form-control" id="year" name="year"> <!-- placeholder="name@example.com" -->
                    </div>

                    <div class="mb-3">
                        <label for="source" class="form-label">Источник</label>
                        <input type="text" class="form-control" id="source" name="source"> <!-- placeholder="name@example.com" -->
                    </div>

                    <select class="form-select" aria-label="Default select example" name="category">
                        <option selected>Выберите категорию</option>
                        <option value="1">Юмор</option>
                        <option value="2">Философия</option>
                        <option value="3">История</option>
                    </select>

                    <input class="btn btn-primary" type="submit" value="Отправить">


                </form>

            </div>
        </div>
    </div>


@endsection

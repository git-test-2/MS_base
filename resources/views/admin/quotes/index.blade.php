@extends('layouts.admin_layout')


@section('title','Админка')

@section('content')

    <h4>Секция цитат</h4>

    {{-- Проверка на наличие сообщения об успехе --}}
    @if(session('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif


    <!-- Ссылки -->
    <div>
        <a href="{{ route('admin.quotes.create') }}" class="btn btn-success">Добавить цитату</a>
    </div>


    <!-- $quotes -->
    <div class="container mt-4">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Цитата</th>
                <th scope="col">Автор</th>
                <th scope="col">Год</th>
                <th scope="col">Источник</th>
                <th scope="col">Категория</th>
                <th scope="col">Лайки</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($quotes as $quote)
                <tr>
                    <th scope="row">{{ $quote->id }}</th>
                    <td>{{ $quote->quote }}</td>
                    <td>{{ $quote->author }}</td>
                    <td>{{ $quote->year }}</td>
                    <td>{{ $quote->source }}</td>
                    <td>{{ $quote->category }}</td>
                    <td>{{ $quote->likes }}</td>
                    <td>
                        <a href="{{ route('admin.quotes.edit', $quote->id) }}" class="btn btn-warning btn-sm">Редактировать</a>

                        <!-- onsubmit - окно подтверждения перед удалением -->
                        <form action="{{ route('admin.quotes.destroy', $quote->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить цитату?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    {{ $quotes->links('vendor.pagination.bootstrap-4') }} <!-- Пагинация -->

    </div>

@endsection

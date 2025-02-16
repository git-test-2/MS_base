@extends('layouts.admin_layout')

@section('title', 'Редастировать цитату')

@section('content')

    <h4>Редактировать цитату</h4>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">

                <form action="{{ route('admin.quotes.update', $quote->id) }}" method="post">
                @csrf
                @method('PUT') <!-- Указываем, что это запрос PUT -->

                    <div class="mb-3">
                        <label for="quote" class="form-label">Цитата</label>
                        <textarea class="form-control" id="quote" rows="3"
                                  name="quote">{{ old('quote', $quote->quote) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Автор</label>
                        <input type="text" class="form-control" id="author" name="author"
                               value="{{ old('author', $quote->author) }}">
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Дата цитаты</label>
                        <input type="text" class="form-control" id="year" name="year"
                               value="{{ old('year', $quote->year) }}">
                    </div>

                    <div class="mb-3">
                        <label for="source" class="form-label">Источник</label>
                        <input type="text" class="form-control" id="source" name="source"
                               value="{{ old('source', $quote->source) }}">
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Категория</label>
                        <select class="form-select" id="category" name="category">
                            <option value="1" {{ $quote->category == 1 ? 'selected' : '' }}>Юмор</option>
                            <option value="2" {{ $quote->category == 2 ? 'selected' : '' }}>Философия</option>
                            <option value="3" {{ $quote->category == 3 ? 'selected' : '' }}>История</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="likes" class="form-label">Лайки</label>
                        <input type="text" class="form-control" id="likes" name="likes" value="{{ old('likes', $quote->likes) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>

                </form>

            </div>
        </div>
    </div>


@endsection

@extends('layouts.main_layout')

@section('title','Цитаты')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h4 class="text-center mb-4">📌 Цитаты из MindSpace:</h4>

                @if($quotes->count())
                    @foreach($quotes as $quote)
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <p class="fs-5">"{{ $quote->quote }}"</p>
                                @if($quote->author)
                                    <p class="text-end text-muted">— {{ $quote->author }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">❌ Пока нет цитат.</p>
            @endif

            <!-- Центрируем пагинацию -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $quotes->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

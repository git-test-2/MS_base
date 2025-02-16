@extends('layouts.main_layout')

@section('title', 'Контакты')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px; border-radius: 15px;">
            <h3 class="text-center mb-4">Свяжитесь с нами</h3>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact_form_process') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Электронная почта</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}" required placeholder="Ваш email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="userMessage" class="form-label">Сообщение</label>
                    <textarea class="form-control @error('message') is-invalid @enderror"
                              id="userMessage" name="userMessage" rows="4" required placeholder="Ваше сообщение">{{ old('userMessage') }}</textarea>
                    @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Отправить сообщение</button>
            </form>
        </div>
    </div>
@endsection



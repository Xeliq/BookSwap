@extends('layouts.app')

@section('title', 'Zarejestruj się')

@section('content')
<div class="container">
    <div class="card">
        <h2>Zarejestruj się</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nazwa:</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Hasło:</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">Potwierdź hasło:</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zarejestruj się</button>
            </div>
        </form>
    </div>
</div>
@endsection
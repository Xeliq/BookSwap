@extends('layouts.app')

@section('title', 'Zaloguj się')

@section('content')
<div class="container">
    <div class="card">
        <h2>Zaloguj się</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
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
                <button type="submit" class="btn btn-primary">Zaloguj się</button>
            </div>

        </form>
    </div>
</div>
@endsection
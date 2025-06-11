@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h2>Dodaj Administratora</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="<?=config('app.url'); ?>/admin/store" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Imię:</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Potwierdź hasło:</label>
                    <input type="password" name="password_confirmation" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Dodaj Admina</button>
            </form>
        </div>
    </div>
@endsection

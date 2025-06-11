@extends('layouts.app')

@section('title', 'Napisz wiadomość')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Napisz wiadomość</h1>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="<?=config('app.url'); ?>/wiadomosci" method="POST">
                @csrf

                <input type="hidden" name="nadawca_id" value="{{ Auth::id() }}">
                <input type="hidden" name="odbiorca_id" value="{{ $odbiorca_id }}">

                <div class="form-group">
                    <label for="tresc">Treść:</label>
                    <textarea name="tresc" id="tresc" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Wyślij</button>
            </form>
            <br><br>
            <a href="javascript:history.back()" class="btn btn-secondary">Powrót</a>
        </div>
    </div>
@endsection

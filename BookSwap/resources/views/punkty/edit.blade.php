@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Edytuj punkt</h1>

            <form action="<?=config('app.url'); ?>/punkty/{{ $punkty->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="uzytkownik">ID użytkownika</label>
                    <input type="text" name="uzytkownik" value="{{ $punkty->uzytkownik_id }}" required>
                </div>

                <div class="form-group">
                    <label for="liczba_punktow">Liczba punktów</label>
                    <input type="text" name="liczba_punktow" value="{{ $punkty->liczba_punktow }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Zapisz</button>
            </form>
        </div>
    </div>
@endsection

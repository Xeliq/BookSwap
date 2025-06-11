@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Dodaj punkty</h1>

            <form action="<?=config('app.url'); ?>/punkty" method="POST">
                @csrf
                <div class="form-group">
                    <label for="uzytkownik_id">ID użytkownika</label>
                    <input type="text" name="uzytkownik_id" required>
                </div>

                <div class="form-group">
                    <label for="liczba_punktow">Liczba punktów</label>
                    <input type="text" name="liczba_punktow" required>
                </div>

                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
    @endsection

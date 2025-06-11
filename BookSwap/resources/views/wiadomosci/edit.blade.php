@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Edytuj wiadomość</h1>

            <form action="<?=config('app.url'); ?>/wiadomosci/{{ $wiadomosc->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nadawca_id">Nadawca:</label>
                    <input type="text" name="nadawca_id" id="nadawca_id">
                </div>

                <div class="form-group">
                    <label for="odbiorca_id">Odbiorca:</label>
                    <input type="text" name="odbiorca_id" id="odbiorca_id">
                </div>

                <div class="form-group">
                    <label for="tresc">Treść wiadomości:</label>
                    <textarea name="tresc" required></textarea>
                </div>

                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="date" name="data" id="data">
                </div>

                <button type="submit" class="btn btn-primary">Zapisz</button>
            </form>
        </div>
    </div>
@endsection

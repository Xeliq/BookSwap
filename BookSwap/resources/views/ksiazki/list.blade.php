@extends('layouts.app')

@section('title', 'Lista książek')

@section('content')
    <h1>Lista książek</h1>
    <a href="<?=config('app.url'); ?>/ksiazki/create" class="btn btn-primary">Dodaj nową książkę</a>
    <br><br>
<table class="tables">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Autor</th>
            <th>Gatunek</th>
            <th>zdjecie</th>
            <th>uzytkownik id</th>
            <th>status</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ksiazki as $ksiazka)
            <tr>
                <td>{{ $ksiazka->id }}</td>
                <td>{{ $ksiazka->tytul }}</td>
                <td>{{ $ksiazka->autor }}</td>
                <td>{{ $ksiazka->gatunek }}</td>
                <td><img src="{{ asset('uploads/' . $ksiazka->zdjecie) }}" alt="Okładka książki" width="100" height="100"></td>
                <td>{{ $ksiazka->uzytkownik_id }}</td>
                <td>{{ $ksiazka->status }}</td>
                <td>
                    <a href="<?=config('app.url'); ?>/ksiazki/{{ $ksiazka->id }}" class="btn btn-secondary">Pokaż</a>
                    <a href="<?=config('app.url'); ?>/ksiazki/{{ $ksiazka->id }}/edit" class="btn btn-secondary">Edytuj</a>
                    <form action="<?=config('app.url'); ?>/ksiazki/{{ $ksiazka->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Czy na pewno chcesz usunąć tę książkę?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

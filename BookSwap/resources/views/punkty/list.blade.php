@extends('layouts.app')

@section('title', 'Lista punktów')

@section('content')
<h1>Lista Punktów</h1>

<a href="<?=config('app.url'); ?>/punkty/create" class="btn btn-primary">Dodaj punkty</a>
<br><br>
<table class="tables">
    <thead>
        <tr>
            <th>ID użytkownika</th>
            <th>Liczba punktów</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($punkty as $punkt)
        <tr>
            <td>{{ $punkt->uzytkownik_id }}</td>
            <td>{{ $punkt->liczba_punktow }}</td>
            <td>
                <a href="<?=config('app.url'); ?>/punkty/{{ $punkt->id }}/edit" class="btn btn-secondary">Edytuj</a>
                <form action="<?=config('app.url'); ?>/punkty/{{ $punkt->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Czy na pewno chcesz usunąć te punkty?');">
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

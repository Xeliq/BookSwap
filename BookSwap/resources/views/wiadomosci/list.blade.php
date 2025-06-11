@extends('layouts.app')

@section('content')
<h1>Lista Wiadomości</h1>

<a href="<?=config('app.url'); ?>/wiadomosci/create" class="btn btn-primary">Dodaj nową wiadomość</a>
<br><br>
<table class="tables">
    <thead>
        <tr>
            <th>ID</th>
            <th>Od (Nadawca)</th>
            <th>Do (Odbiorca)</th>
            <th>Treść</th>
            <th>Data</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($wiadomosci as $wiadomosc)
        <tr>
            <td>{{ $wiadomosc->id }}</td>
            <td>{{ $wiadomosc->nadawca->email }}</td>
            <td>{{ $wiadomosc->odbiorca->email }}</td>
            <td>{{ Str::limit($wiadomosc->tresc, 30) }}</td>
            <td>{{ $wiadomosc->data }}</td>
            <td>
                <a href="<?=config('app.url'); ?>/wiadomosci/{{ $wiadomosc->id }}" class="btn btn-secondary">Pokaż</a>
                <a href="<?=config('app.url'); ?>/wiadomosci/{{ $wiadomosc->id }}/edit" class="btn btn-secondary">Edytuj</a>
                <form action="<?=config('app.url'); ?>/wiadomosci/{{ $wiadomosc->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Czy na pewno chcesz usunąć tę wiadomość?');">
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

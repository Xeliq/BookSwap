@extends('layouts.app')

@section('content')
<h1>Lista Wymian</h1>

<a href="<?=config('app.url'); ?>/wymiany/create" class="btn btn-primary">Dodaj nową wymianę</a>
<br><br>
<table class="tables">
    <thead>
        <tr>
            <th>ID</th>
            <th>Książka</th>
            <th>Offered Książka</th>
            <th>Requester</th>
            <th>Recipient</th>
            <th>Data</th>
            <th>Status</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($wymiany as $wymiana)
        <tr>
            <td>{{ $wymiana->id }}</td>
            <td>{{ $wymiana->ksiazka->tytul }}</td>
            <td>{{ $wymiana->offeredKsiazka ? $wymiana->offeredKsiazka->tytul : 'N/A' }}</td>
            <td>{{ $wymiana->requester ? $wymiana->requester->email : 'N/A' }}</td>
            <td>{{ $wymiana->recipient ? $wymiana->recipient->email : 'N/A' }}</td>
            <td>{{ $wymiana->data }}</td>
            <td>{{ $wymiana->status }}</td>
            <td>
                <a href="<?=config('app.url'); ?>/wymiany/{{ $wymiana->id }}" class="btn btn-secondary">Pokaż</a>
                <a href="<?=config('app.url'); ?>/wymiany/{{ $wymiana->id }}/edit" class="btn btn-secondary">Edytuj</a>
                <form action="<?=config('app.url'); ?>/wymiany/{{ $wymiana->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Czy na pewno chcesz usunąć tę wymianę?');">
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

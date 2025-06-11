@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Szczegóły wymiany</h1>

    <table>
        <tr>
            <td><strong>ID:</strong></td>
            <td>{{ $wymiana->id }}</td>
        </tr>
        <tr>
            <td><strong>Książka:</strong></td>
            <td>{{ $wymiana->ksiazka->tytul }}</td>
        </tr>
        <tr>
            <td><strong>Offered Książka:</strong></td>
            <td>{{ $wymiana->offeredKsiazka ? $wymiana->offeredKsiazka->tytul : 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Requester:</strong></td>
            <td>{{ $wymiana->requester ? $wymiana->requester->email : 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Recipient:</strong></td>
            <td>{{ $wymiana->recipient ? $wymiana->recipient->email : 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Data:</strong></td>
            <td>{{ $wymiana->data }}</td>
        </tr>
        <tr>
            <td><strong>Status:</strong></td>
            <td>{{ $wymiana->status }}</td>
        </tr>
    </table>

    <a href="{{ url('/wymiany/' . $wymiana->id . '/edit') }}"  class="btn btn-secondary">Edytuj</a>
    <form action="{{ url('/wymiany/' . $wymiana->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Czy na pewno chcesz usunąć tę wymianę?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Usuń</button>
    </form>

    @if($wymiana->recipient_id == Auth::id() && $wymiana->status == 'requested')
        <form action="{{ url('/wymiany/' . $wymiana->id . '/accept') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Zaakceptuj ofertę</button>
        </form>
    @endif
</div>
@endsection

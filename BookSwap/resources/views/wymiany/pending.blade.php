@extends('layouts.app')

@section('content')
<h1>Pending Exchanges</h1>

@if($pendingExchanges->isEmpty())
    <p>No pending exchanges.</p>
@else
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Książka</th>
                <th>Offered Książka</th>
                <th>Requester</th>
                <th>Data</th>
                <th>Status</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingExchanges as $exchange)
            <tr>
                <td>{{ $exchange->id }}</td>
                <td>{{ $exchange->ksiazka->tytul }}</td>
                <td>{{ $exchange->offeredKsiazka ? $exchange->offeredKsiazka->tytul : 'N/A' }}</td>
                <td>{{ $exchange->requester ? $exchange->requester->email : 'N/A' }}</td>
                <td>{{ $exchange->data }}</td>
                <td>{{ $exchange->status }}</td>
                <td>
                    <a href="{{ url('/wymiany/' . $exchange->id) }}">Pokaż</a>
                    <a href="{{ url('/wymiany/' . $exchange->id . '/edit') }}">Edytuj</a>
                    <form action="{{ url('/wymiany/' . $exchange->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Czy na pewno chcesz usunąć tę wymianę?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection

@extends('layouts.app')

@section('content')
<div class="container center-content">
    <h1>Informacje o użytkowniku</h1>

    <table>
        <tr>
            <td><strong>ID:</strong></td>
            <td>{{ $uzytkownik->id }}</td>
        </tr>
        <tr>
            <td><strong>Nazwa:</strong></td>
            <td>{{ $uzytkownik->name }}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>{{ $uzytkownik->email }}</td>
        </tr>
        <tr>
            <td><strong>Rola:</strong></td>
            <td>{{ $uzytkownik->rola }}</td>
        </tr>
    </table>

    <a href="{{ url('/uzytkownicy/' . $uzytkownik->id . '/edit') }}">Edytuj</a>
    <form action="{{ url('/uzytkownicy/' . $uzytkownik->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');">
        @csrf
        @method('DELETE')
        <button type="submit">Usuń</button>
    </form>
    <a href="{{ url('/uzytkownicy') }}">Powrót do listy</a>
</div>
@endsection

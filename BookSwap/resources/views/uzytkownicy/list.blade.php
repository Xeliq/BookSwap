@extends('layouts.app')

@section('content')
<h1>Lista użytkowników</h1>

<a href="{{ url('/uzytkownicy/create') }}" class="btn btn-primary">Dodaj użytkownika</a>
<br><br>
<table class="tables">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Email</th>
            <th>Rola</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($uzytkownicy as $uzytkownik)
        <tr>
            <td>{{ $uzytkownik->id }}</td>
            <td>{{ $uzytkownik->name }}</td>
            <td>{{ $uzytkownik->email }}</td>
            <td>{{ $uzytkownik->rola }}</td>
            <td>
                <a href="{{ url('/uzytkownicy/' . $uzytkownik->id . '/edit') }}" class="btn btn-secondary">Edytuj</a>
                <form action="{{ url('/uzytkownicy/' . $uzytkownik->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');">
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

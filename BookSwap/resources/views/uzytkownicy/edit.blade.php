@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Edytuj użytkownika</h1>

            <form action="{{ url('/uzytkownicy/' . $uzytkownik->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nazwa:</label>
                    <input type="text" name="name" value="{{ $uzytkownik->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="{{ $uzytkownik->email }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input type="password" name="password">
                </div>

                <div class="form-group">
                    <label for="rola">Rola:</label>
                    <select name="rola" required>
                        <option value="USER" {{ $uzytkownik->rola == 'USER' ? 'selected' : '' }}>USER</option>
                        <option value="ADMIN" {{ $uzytkownik->rola == 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Zapisz</button>
            </form>
        </div>
    </div>
@endsection
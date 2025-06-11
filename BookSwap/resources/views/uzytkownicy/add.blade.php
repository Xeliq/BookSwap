@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Dodaj nowego użytkownika</h1>

            <form action="{{ url('/uzytkownicy') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nazwa:</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="rola">Rola:</label>
                    <select name="rola" required>
                        <option value="USER">USER</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
@endsection

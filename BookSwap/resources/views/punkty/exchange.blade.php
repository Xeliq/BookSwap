@extends('layouts.app')

@section('title', 'Wymień punkty na nagrody')

@section('content')
<div class="container">
    <div class="card">
        <h2>Wymień punkty na nagrody</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/punkty/exchange') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="reward">Wybierz nagrodę:</label>
                <select name="reward" required>
                    <option value="free_book">Darmowa książka (1000 punktów)</option>
                    <option value="profile_customization">Personalizacja profilu (200 punktów)</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Wymień</button>
            </div>
        </form>
    </div>
</div>
@endsection

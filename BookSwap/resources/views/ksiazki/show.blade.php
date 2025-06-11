@extends('layouts.app')

@section('title', 'Szczegóły książki')

@section('content')
<div class="container center-content">
    <h1>{{ $ksiazka->tytul }}</h1>
    <img src="{{ asset('uploads/' . $ksiazka->zdjecie) }}" alt="Okładka książki" width="300" height="400">
    <p>Autor: {{ $ksiazka->autor }}</p>
    <p>Gatunek: {{ $ksiazka->gatunek }}</p>
    @auth
        @if(Auth::id() != $ksiazka->uzytkownik_id)
            <a href="{{ url('/wiadomosci/create?recipient=' . $ksiazka->uzytkownik_id) }}" class="btn btn-primary">Napisz wiadomość</a><br>
            <a href="{{ route('exchange.view', ['book_id' => $ksiazka->id]) }}" class="btn btn-primary">Zaproponuj wymianę</a>
        @endif
    @else
        <a href="{{ url('/login') }}" class="btn btn-primary">Zaloguj się, aby napisać wiadomość</a>
    @endauth
    <br><br>
    @if(Auth::user() && Auth::user()->is_admin)
        <a href="<?=config('app.url'); ?>ksiazki/{{ $ksiazka->id }}/edit">Edytuj</a>
        <form action="<?=config('app.url'); ?>/ksiazki/{{ $ksiazka->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Czy na pewno chcesz usunąć tę książkę?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Usuń</button>
        </form>
    @endif
    <br><br>
    <a href="javascript:history.back()" class="btn btn-secondary">Powrót</a>
</div>
@endsection

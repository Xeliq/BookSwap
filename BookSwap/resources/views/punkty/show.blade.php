@extends('layouts.app')

@section('content')
<div class="container center-content">
    <p>ID użytkownika: {{ $punkt->uzytkownik_id }}</p>
    <p>Liczba punktów: {{ $punkt->liczba_punktow }}</p>

    <a href="<?=config('app.url'); ?>/punkty/{{ $punkt->id }}/edit">Edytuj</a>

    <form action="<?=config('app.url'); ?>/punkty/{{ $punkt->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Usuń</button>
    </form>
</div>
@endsection

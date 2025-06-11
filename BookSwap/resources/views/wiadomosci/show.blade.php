@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Wiadomość</h1>
    <p><strong>ID</strong> {{ $wiadomosc->id }}</p>
    <p><strong>Od:</strong> {{ $wiadomosc->nadawca->email }}</p>
    <p><strong>Do:</strong> {{ $wiadomosc->odbiorca->email }}</p>
    <p><strong>Treść:</strong> {{ $wiadomosc->tresc }}</p>
    <p><strong>Data:</strong> {{ $wiadomosc->data }}</p>

    <a href="<?=config('app.url'); ?>/wiadomosci/{{ $wiadomosc->id }}/edit"  class="btn btn-secondary">Edytuj</a>

    <form action="<?=config('app.url'); ?>/wiadomosci/{{ $wiadomosc->id }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę książkę?');">
        @csrf
        @method('DELETE')
        <button type="submit" calss="btn btn-danger">Usuń</button>
    </form>
</div>
@endsection

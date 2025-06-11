@extends('layouts.app')

@section('title', 'Strona główna')

@section('content')
<div class="container center-content">
    <h1>Witaj w BookSwap!</h1>
    <p>Wymieniaj książki z innymi użytkownikami i ciesz się nowymi pozycjami w swojej bibliotece.</p>

    <div class="search">
        <form action="{{ config('app.url') }}/ksiazki/search" method="get" class="search-form">
            <input type="text" name="query" placeholder="Wyszukaj książki..." class="search-input" />
            <button type="submit" class="btn btn-primary search-button">Szukaj</button>
        </form>
    </div>
</div>
    <div class="categories">
        <h2>Przeglądaj według gatunku</h2>
        <ul style="list-style-type: none;">
            <li><a href="<?=config('app.url'); ?>/ksiazki/gatunek/Fantasy">Fantasy</a></li>
            <li><a href="<?=config('app.url'); ?>/ksiazki/gatunek/Science Fiction">Science Fiction</a></li>
            <li><a href="<?=config('app.url'); ?>/ksiazki/gatunek/Kryminał">Kryminał</a></li>
            <li><a href="<?=config('app.url'); ?>/ksiazki/gatunek/Romans">Romans</a></li>
            <li><a href="<?=config('app.url'); ?>/ksiazki/gatunek/Horror">Horror</a></li>
            <li><a href="<?=config('app.url'); ?>/ksiazki/gatunek/Biografia">Biografia</a></li>
        </ul>
    </div>

    <div class="lists">
        @if(isset($selectedGatunek))
            <h2>Książki z gatunku: {{ $selectedGatunek }}</h2>
        @else
            <h2>Przykładowe książki do wymiany</h2>
        @endif
        <div class="book-grid">
            @foreach ($ksiazki as $ksiazka)
                @if(Auth::id() != $ksiazka->uzytkownik_id && $ksiazka->status != 'niedostepna')
                    <div class="book-item">
                        <img src="{{ asset('uploads/' . $ksiazka->zdjecie) }}" alt="Okładka książki" width="150" height="200">
                        <h3>{{ $ksiazka->tytul }}</h3>
                        <p>{{ $ksiazka->autor }}</p>
                        <p>{{ $ksiazka->gatunek }}</p>
                        <a href="{{ config('app.url') }}/ksiazki/{{ $ksiazka->id }}">Pokaż</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

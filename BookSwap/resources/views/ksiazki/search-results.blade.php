@extends('layouts.app')

@section('title', 'Wyniki wyszukiwania')

@section('content')
    <h1>Wyniki wyszukiwania dla: "{{ $query }}"</h1>

    @if($ksiazki->isEmpty())
        <p>Brak wyników dla podanego zapytania.</p>
    @else
        <div class="book-grid">
            @foreach ($ksiazki as $ksiazka)
                @if(Auth::id() != $ksiazka->uzytkownik_id && $ksiazka->status != 'niedostepna')
                    <div class="book-item">
                        <img src="{{ asset('uploads/' . $ksiazka->zdjecie) }}" alt="Okładka książki" width="100" height="150">
                        <h3>{{ $ksiazka->tytul }}</h3>
                        <p>{{ $ksiazka->autor }}</p>
                        <p>{{ $ksiazka->gatunek }}</p>
                        <a href="<?=config('app.url'); ?>/ksiazki/{{ $ksiazka->id }}">Pokaż</a>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endsection

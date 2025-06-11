@extends('layouts.app')

@section('content')
<div class="center-content">
    <h2>Oczekujące wymiany</h2>

    @php
        // Filtrowanie wymian, gdzie aktualny użytkownik jest odbiorcą
        $userExchanges = $pendingExchanges->where('recipient_id', Auth::id());
    @endphp

    @if ($userExchanges->isEmpty())
        <p>Nie masz żadnych oczekujących wymian do rozpatrzenia.</p>
    @else
        @foreach ($userExchanges as $exchange)
            @if($exchange->ksiazka->status != 'niedostepna')
                <div class="exchange">
                    <p>Twoja książka: {{ $exchange->ksiazka ? $exchange->ksiazka->tytul : 'N/A' }}</p>
                    <p>Otrzymasz: {{ $exchange->offeredKsiazka ? $exchange->offeredKsiazka->tytul : 'N/A' }}</p>
                    <p>
                        Od: {{ $exchange->requester ? $exchange->requester->name : 'N/A' }}
                        ({{ $exchange->requester ? $exchange->requester->email : 'N/A' }})
                    </p>
                    <a href="{{ route('exchange.accept', $exchange->id) }}" class="btn btn-primary">Akceptuj wymianę</a>
                    <a href="{{ route('exchange.deny', $exchange->id) }}" class="btn btn-danger">Odrzuć wymianę</a>
                </div>
            @endif
        @endforeach
    @endif
</div>
@endsection

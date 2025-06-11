@extends('layouts.app')

@section('content')
<div class="center-content">
<h1>Zaproponuj wymianę</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('exchange.request') }}" method="POST">
    @csrf
    <input type="hidden" name="book_id_b" value="{{ $book_id }}">
    <label for="book_id_a">Wybierz swoją książkę do wymiany:</label>
    <select name="book_id_a">
        @foreach (Auth::user()->ksiazki as $myBook)
            @if ($myBook->status != 'niedostepna')
            <option value="{{ $myBook->id }}">{{ $myBook->tytul }}</option>
            @endif
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Zaproponuj wymianę</button>
</form>
</div>
@endsection

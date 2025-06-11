@extends('layouts.app')

@section('title', 'Napisz wiadomość')

@section('content')
<div class="center-content">
    <h1>Napisz wiadomość</h1>

    <form action="{{ url('/wiadomosci') }}" method="POST">
        @csrf
        <input type="hidden" name="nadawca_id" value="{{ Auth::id() }}">
        <input type="hidden" name="odbiorca_id" value="{{ request('recipient') }}">
        @if(request('reply'))
            <input type="hidden" name="reply" value="true">
        @endif

        <label for="tresc">Treść:</label>
        <br>
        <textarea id="tresc" name="tresc" required></textarea>
        <br><br>
        <button type="submit" class="btn btn-primary">Wyślij</button>
    </form>
</div>
    
@endsection

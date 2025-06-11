@extends('layouts.app')

@section('title', 'Edytuj książkę')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Edytuj książkę</h1>

            <form action="<?=config('app.url'); ?>/ksiazki/{{ $ksiazka->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="tytul">Tytuł:</label>
                    <input type="text" name="tytul" value="{{ $ksiazka->tytul }}" required>
                </div>

                <div class="form-group">
                    <label for="autor">Autor:</label>
                    <input type="text" name="autor" value="{{ $ksiazka->autor }}" required>
                </div>

                <div class="form-group">
                    <label for="gatunek">Gatunek:</label>
                    <select id="gatunek" name="gatunek" required>
                        <option value="Fantasy" {{ $ksiazka->gatunek == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                        <option value="Science Fiction" {{ $ksiazka->gatunek == 'Science Fiction' ? 'selected' : '' }}>Science Fiction</option>
                        <option value="Romans" {{ $ksiazka->gatunek == 'Romans' ? 'selected' : '' }}>Romans</option>
                        <option value="Horror" {{ $ksiazka->gatunek == 'Horror' ? 'selected' : '' }}>Horror</option>
                        <option value="Biografia" {{ $ksiazka->gatunek == 'Biografia' ? 'selected' : '' }}>Biografia</option>
                    </select>
                </div>

                <label for="zdjecie">Zdjęcie:</label>
                <input type="file" name="zdjecie">
                <br><br>

                <button type="submit" class="btn btn-primary">Zapisz</button>
            </form>
@endsection

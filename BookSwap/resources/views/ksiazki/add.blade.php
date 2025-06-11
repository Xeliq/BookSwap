@extends('layouts.app')

@section('title', 'Dodaj książkę')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Dodaj książkę</h1>

            <form action="<?=config('app.url'); ?>/ksiazki" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="tytul">Tytuł:</label>
                    <input type="text" id="tytul" name="tytul" required>
                </div>

                <div class="form-group">
                    <label for="autor">Autor:</label>
                    <input type="text" id="autor" name="autor" required>
                </div>

                <div class="form-group">
                    <label for="gatunek">Gatunek:</label>
                    <select id="gatunek" name="gatunek" required>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Science Fiction">Science Fiction</option>
                        <option value="Romans">Romans</option>
                        <option value="Horror">Horror</option>
                        <option value="Biografia">Biografia</option>
                    </select>
                </div>

                    <label for="zdjecie">Zdjęcie:</label>
                    <input type="file" id="zdjecie" name="zdjecie">

                <br><br>
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
@endsection

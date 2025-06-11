@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Edytuj wymianę</h1>

            <form action="{{ url('/wymiany/' . $wymiana->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="ksiazka_id">Książka id:</label>
                    <input type="text" name="ksiazka_id" value="{{ $wymiana->ksiazka_id }}" required>
                </div>

                <div class="form-group">
                    <label for="offered_ksiazka_id">Offered Książka id:</label>
                    <input type="text" name="offered_ksiazka_id" value="{{ $wymiana->offered_ksiazka_id }}" required>
                </div>

                <div class="form-group">    
                    <label for="requester_id">Requester id:</label>
                    <input type="text" name="requester_id" value="{{ $wymiana->requester_id }}" required>
                </div>

                <div class="form-group">
                    <label for="recipient_id">Recipient id:</label>
                    <input type="text" name="recipient_id" value="{{ $wymiana->recipient_id }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" required>
                        <option value="requested" {{ $wymiana->status == 'requested' ? 'selected' : '' }}>Requested</option>
                        <option value="accepted" {{ $wymiana->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="completed" {{ $wymiana->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <br><br>

                <button type="submit" class="btn btn-primary">Zapisz</button>
            </form>
@endsection

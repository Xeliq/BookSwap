@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Dodaj nową wymianę</h1>

            <form action="{{ url('/wymiany') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="ksiazka_id">Książka id:</label>
                    <input type="text" name="ksiazka_id" required>
                </div>

                <div class="form-group">
                    <label for="offered_ksiazka_id">Offered Książka id:</label>
                    <input type="text" name="offered_ksiazka_id" required>
                </div>

                <div class="form-group">
                    <label for="requester_id">Requester id:</label>
                    <input type="text" name="requester_id" required>
                </div>

                <div class="form-group">    
                    <label for="recipient_id">Recipient id:</label>
                    <input type="text" name="recipient_id" required>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" required>
                        <option value="requested">Requested</option>
                        <option value="accepted">Accepted</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <br><br>

                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
@endsection

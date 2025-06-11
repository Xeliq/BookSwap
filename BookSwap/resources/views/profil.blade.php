@extends('layouts.app')

@section('title', 'Strona profilowa')

@section('content')
    <div>
        <h2 class="{{ $user->profile_theme == 'custom' ? 'custom-theme' : '' }}">Profil użytkownika</h2>
        
        <div class="lists">
            <table>
                <tr>
                    <td><strong>Nazwa:</strong></td>
                    <td class="{{ $user->profile_theme == 'custom' ? 'custom-theme' : '' }}">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td class="{{ $user->profile_theme == 'custom' ? 'custom-theme' : '' }}">{{ $user->email }}</td>
                </tr>
                <tr>
                    <td><strong>Liczba punktów:</strong></td>
                    <td class="{{ $user->profile_theme == 'custom' ? 'custom-theme' : '' }}"><a href="{{ url('/punkty/exchange') }}">{{ $punkty->liczba_punktow ?? 0 }}</a></td>
                </tr>
            </table>
        </div>

        <div  class="tables">
            <h3>Twoje książki:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Tytuł</th>
                        <th>Autor</th>
                        <th>Gatunek</th>
                        <th>Zdjęcie</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ksiazki as $ksiazka)
                    @if ($ksiazka->status != 'niedostepna')
                    <tr>
                        <td>{{ $ksiazka->tytul }}</td>
                        <td>{{ $ksiazka->autor }}</td>
                        <td>{{ $ksiazka->gatunek }}</td>
                        <td><img src="{{ asset('uploads/' . $ksiazka->zdjecie) }}" alt="Okładka książki" width="100" height="200"></td>
                        <td>
                            <a href="{{ url('/ksiazki/' . $ksiazka->id . '/edit') }}" class="btn btn-secondary">Edytuj</a>
                            <form action="{{ url('/ksiazki/' . $ksiazka->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Czy na pewno chcesz usunąć tę książkę?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Usuń</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        <br>
        <a href="{{ url('/ksiazki/create') }}" class="btn btn-primary">Dodaj nową książkę</a>
        </div>
       
        <div class="lists">
            <h3>Odebrane wiadomości:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nadawca</th>
                        <th>Treść</th>
                        <th>Data</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wiadomosciOdebrane as $wiadomosc)
                    <tr>
                        <td>{{ $wiadomosc->nadawca->name }}</td>
                        <td>{{ $wiadomosc->tresc }}</td>
                        <td>{{ $wiadomosc->data }}</td>
                        <td>
                            <a href="{{ url('/wiadomosci/create?recipient=' . $wiadomosc->nadawca->id . '&reply=true') }}" class="btn btn-secondary">Odpowiedz</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="lists">
            <h3>Wysłane wiadomości:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Odbiorca</th>
                        <th>Treść</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wiadomosciWyslane as $wiadomosc)
                    <tr>
                        <td>{{ $wiadomosc->odbiorca->name }}</td>
                        <td>{{ $wiadomosc->tresc }}</td>
                        <td>{{ $wiadomosc->data }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div  class="tables">
            <h3>Historia wymian:</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Książka</th>
                        <th>Oferowana Książka</th>
                        <th>Żądający</th>
                        <th>Odiorca</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wymiany as $wymiana)
                    <tr>
                        <td>{{ $wymiana->id }}</td>
                        <td>{{ $wymiana->ksiazka->tytul }}</td>
                        <td>{{ $wymiana->offeredKsiazka ? $wymiana->offeredKsiazka->tytul : 'N/A' }}</td>
                        <td>{{ $wymiana->requester ? $wymiana->requester->email : 'N/A' }}</td>
                        <td>{{ $wymiana->recipient ? $wymiana->recipient->email : 'N/A' }}</td>
                        <td>{{ $wymiana->data }}</td>
                        <td>{{ $wymiana->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <a href="{{ url('/exchange/pending') }}" class="btn btn-primary">Zobacz prośby</a>
        </div>
    </div>
@endsection

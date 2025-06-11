<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Moja aplikacja')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?=config('app.url'); ?>/">Strona główna</a></li>
                @if(Auth::check())
                    <li><a href="<?=config('app.url'); ?>/ksiazki">Książki</a></li>
                    <li><a href="<?=config('app.url'); ?>/punkty">Punkty</a></li>
                    <li><a href="<?=config('app.url'); ?>/wiadomosci">Wiadomości</a></li>
                    <li><a href="<?=config('app.url'); ?>/wymiany">Wymiany</a></li>
                    <li><a href="<?=config('app.url'); ?>/profil">Profil</a></li>
                    <li><a href="<?=config('app.url'); ?>/admin/create">Dodanie admina</a></li>
                    <li><a href="<?=config('app.url'); ?>/wyloguj">Wyloguj</a></li>
                @else
                    <li><a href="<?=config('app.url'); ?>/login">Zaloguj</a></li>
                    <li><a href="<?=config('app.url'); ?>/register">Zarejestruj</a></li>
                @endif

            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 BookSwap. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>

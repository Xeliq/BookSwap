<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WymianyController;

class ProfilController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $punkty = $user->punkty;
        $wiadomosciOdebrane = $user->wiadomosciOdebrane ?? collect();
        $wiadomosciWyslane = $user->wiadomosciWyslane ?? collect();
        
        $wymianyController = new WymianyController();
        $wymiany = $wymianyController->getUserExchanges();
        
        // $wymianyList = $user->wymiany ?? collect();
        $ksiazki = $user->ksiazki ?? collect();

        return view('profil', compact('user', 'punkty', 'wiadomosciOdebrane', 'wiadomosciWyslane', 'wymiany', 'ksiazki'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());

        return redirect()->back()->with('success', 'Profil został zaktualizowany.');
    }
}

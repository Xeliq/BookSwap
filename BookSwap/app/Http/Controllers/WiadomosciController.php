<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wiadomosci;
use Illuminate\Support\Facades\Auth;

class WiadomosciController extends Controller
{
    public function index()
    {
        $wiadomosci = Wiadomosci::all();
        return view('wiadomosci.list', ['wiadomosci' => $wiadomosci]);
    }

    public function create(Request $request)
    {
        return view('wiadomosci.create', ['recipient' => $request->query('recipient')]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nadawca_id' => 'required|exists:users,id',
            'odbiorca_id' => 'required|exists:users,id',
            'tresc' => 'required|string|max:1000',
        ]);

        $wiadomosc = Wiadomosci::create($request->all());

        if ($request->has('reply')) {
            return redirect('/profil')->with('success', 'Odpowiedź została wysłana.');
        }

        return redirect('/profil')->with('success', 'Wiadomość została wysłana.');
    }

    public function show($id)
    {
        $wiadomosc = Wiadomosci::find($id);
        if (!$wiadomosc) {
            return view('wiadomosci.message', ['message' => "Wiadomość o ID=$id nie została znaleziona.", 'type_of_message' => 'Error']);
        }
        return view('wiadomosci.show', ['wiadomosc' => $wiadomosc]);
    }

    public function edit($id)
    {
        $wiadomosc = Wiadomosci::find($id);
        if (!$wiadomosc) {
            return view('wiadomosci.message', ['message' => "Wiadomość o ID=$id nie została znaleziona.", 'type_of_message' => 'Error']);
        }
        return view('wiadomosci.edit', ['wiadomosc' => $wiadomosc]);
    }

    public function update(Request $request, $id)
    {
        $wiadomosc = Wiadomosci::find($id);
        if ($wiadomosc) {
            $wiadomosc->update($request->all());
            return redirect('wiadomosci');
        }
        return view('wiadomosci.message', ['message' => "Wiadomość o ID=$id nie została znaleziona.", 'type_of_message' => 'Error']);
    }

    public function destroy($id)
    {
        $wiadomosc = Wiadomosci::find($id);
        if ($wiadomosc) {
            $wiadomosc->delete();
            return redirect('wiadomosci');
        }
        return view('wiadomosci.message', ['message' => "Wiadomość o ID=$id nie została znaleziona.", 'type_of_message' => 'Error']);
    }
}

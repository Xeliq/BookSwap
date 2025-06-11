<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ksiazki;
use Illuminate\Support\Facades\Auth;

class KsiazkiController extends Controller
{
    public function index()
    {
        $ksiazki = Ksiazki::all();
        return view('ksiazki.list', ['ksiazki' => $ksiazki]);
    }

    public function create()
    {
        return view('ksiazki.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tytul' => 'required|min:3|max:255',
            'autor' => 'required|min:3|max:100',
            'gatunek' => 'required|min:3|max:50',
            'zdjecie' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['uzytkownik_id'] = Auth::id();

        if ($request->hasFile('zdjecie')) {
            $file = $request->file('zdjecie');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['zdjecie'] = $filename;
        }

        Ksiazki::create($data);
        return redirect('/profil')->with('success', 'Książka została dodana.');
    }

    public function show($id)
    {
        $ksiazka = Ksiazki::find($id);
        if (!$ksiazka) {
            return view('ksiazki.message', ['message' => "Książka o ID=$id nie została znaleziona.", 'type_of_message' => 'Error']);
        }
        return view('ksiazki.show', ['ksiazka' => $ksiazka]);
    }

    public function edit($id)
    {
        $ksiazka = Ksiazki::find($id);

        if (!$ksiazka) {
            return view('ksiazki.message', [
                'message' => "Książka o ID=$id nie została znaleziona.",
                'type_of_message' => 'Error'
            ]);
        }

        if ($ksiazka->uzytkownik_id !== Auth::id() && Auth::user()->rola !== 'ADMIN') {
            return redirect('/')->with('error', 'Nie masz uprawnień do edycji tej książki.');
        }

        return view('ksiazki.edit', ['ksiazka' => $ksiazka]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tytul' => 'required|min:3|max:255',
            'autor' => 'required|min:3|max:100',
            'gatunek' => 'required|min:3|max:50',
            'zdjecie' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ksiazka = Ksiazki::find($id);

        if (!$ksiazka) {
            return view('ksiazki.message', [
                'message' => "Książka o ID=$id nie została znaleziona.",
                'type_of_message' => 'Error'
            ]);
        }

        if ($ksiazka->uzytkownik_id !== Auth::id() && Auth::user()->rola !== 'ADMIN') {
            return redirect('/')->with('error', 'Nie masz uprawnień do edycji tej książki.');
        }

        $data = $request->except('uzytkownik_id');

        if ($request->hasFile('zdjecie')) {
            $file = $request->file('zdjecie');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['zdjecie'] = $filename;
        }

        $ksiazka->update($data);

        return redirect('/profil')->with('success', 'Książka została zaktualizowana.');
    }


    public function destroy($id)
    {
        $ksiazka = Ksiazki::find($id);

        if (!$ksiazka) {
            return view('ksiazki.message', [
                'message' => "Książka o ID=$id nie została znaleziona.",
                'type_of_message' => 'Error'
            ]);
        }

        if ($ksiazka->uzytkownik_id !== Auth::id() && Auth::user()->rola !== 'ADMIN') {
            return redirect('/')->with('error', 'Nie masz uprawnień do usunięcia tej książki.');
        }

        $ksiazka->delete();
        return redirect('/')->with('success', 'Książka została usunięta.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Ksiazki::where('tytul', 'like', '%' . $query . '%')
                          ->orWhere('autor', 'like', '%' . $query . '%')
                          ->orWhere('gatunek', 'like', '%' . $query . '%')
                          ->get();

        return view('ksiazki.search-results', ['ksiazki' => $results, 'query' => $query]);
    }

    public function filterByGatunek($gatunek)
    {
        $ksiazki = Ksiazki::where('gatunek', $gatunek)->get();
        return view('home', ['ksiazki' => $ksiazki, 'selectedGatunek' => $gatunek]);
    }
}

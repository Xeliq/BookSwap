<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UzytkownicyController extends Controller
{
    public function index()
    {
        $uzytkownicy = User::all();
        return view('uzytkownicy.list', ['uzytkownicy' => $uzytkownicy]);
    }

    public function create()
    {
        return view('uzytkownicy.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50|unique:users',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users',
            'rola' => 'required'
        ]);

        User::create($request->all());
        return redirect('uzytkownicy');
    }

    public function show($id)
    {
        $uzytkownik = User::find($id);
        if (!$uzytkownik) {
            return view('uzytkownicy.message', ['message' => "Użytkownik o ID=$id nie został znaleziony.", 'type_of_message' => 'Error']);
        }
        return view('uzytkownicy.show', ['uzytkownik' => $uzytkownik]);
    }

    public function edit($id)
    {
        $uzytkownik = User::find($id);
        if (!$uzytkownik) {
            return view('uzytkownicy.message', ['message' => "Użytkownik o ID=$id nie został znaleziony.", 'type_of_message' => 'Error']);
        }
        return view('uzytkownicy.edit', ['uzytkownik' => $uzytkownik]);
    }

    public function update(Request $request, $id)
    {
        $uzytkownik = User::find($id);
        if ($uzytkownik) {
            $uzytkownik->update($request->all());
            return redirect('uzytkownicy');
        }
        return view('uzytkownicy.message', ['message' => "Użytkownik o ID=$id nie został znaleziony.", 'type_of_message' => 'Error']);
    }

    public function destroy($id)
    {
        $uzytkownik = User::find($id);
        if ($uzytkownik) {
            $uzytkownik->delete();
            return redirect('uzytkownicy');
        }
        return view('uzytkownicy.message', ['message' => "Użytkownik o ID=$id nie został znaleziony.", 'type_of_message' => 'Error']);
    }
}

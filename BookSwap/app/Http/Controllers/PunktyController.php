<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Punkty;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PunktyController extends Controller
{
    public function index()
    {
        $punkty = Punkty::all();
        return view('punkty.list', ['punkty' => $punkty]);
    }

    public function create()
    {
        return view('punkty.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'uzytkownik_id' => 'required',
            'liczba_punktow' => 'required|integer|min:0'
        ]);

        $data = $request->all();
        $data['liczba_punktow'] = $data['liczba_punktow'] ?? 0;

        Punkty::create($data);
        return redirect('punkty');
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return view('punkty.message', ['message' => "Użytkownik o ID=$id nie został znaleziony.", 'type_of_message' => 'Error']);
        }

        $punkty = $user->punkty;
        if (!$punkty) {
            return view('punkty.message', ['message' => "Punkty dla użytkownika o ID=$id nie zostały znalezione.", 'type_of_message' => 'Error']);
        }

        return view('punkty.show', ['punkty' => $punkty]);
    }

    public function edit($id)
    {
        $punkty = Punkty::find($id);
        if (!$punkty) {
            return view('punkty.message', ['message' => "Punkty dla użytkownika o ID=$id nie zostały znalezione.", 'type_of_message' => 'Error']);
        }
        return view('punkty.edit', ['punkty' => $punkty]);
    }

    public function update(Request $request, $id)
    {
        $punkty = Punkty::find($id);
        if ($punkty) {
            $punkty->update($request->all());
            return redirect('punkty');
        }
        return view('punkty.message', ['message' => "Punkty dla użytkownika o ID=$id nie zostały znalezione.", 'type_of_message' => 'Error']);
    }

    public function destroy($id)
    {
        $punkty = Punkty::find($id);
        if ($punkty) {
            $punkty->delete();
            return redirect('punkty');
        }
        return view('punkty.message', ['message' => "Punkty dla użytkownika o ID=$id nie zostały znalezione.", 'type_of_message' => 'Error']);
    }

    public function showExchangeForm()
    {
        return view('punkty.exchange');
    }

    public function exchange(Request $request)
    {
        $request->validate([
            'reward' => 'required|string',
        ]);

        $user = Auth::user();
        $punkty = $user->punkty;

        switch ($request->input('reward')) {
            case 'free_book':
                if ($punkty->liczba_punktow >= 1000) {
                    $punkty->liczba_punktow -= 1000;
                } else {
                    return redirect()->back()->withErrors(['Nie masz wystarczającej liczby punktów na tę nagrodę.']);
                }
                break;
            case 'profile_customization':
                if ($punkty->liczba_punktow >= 200) {
                    $punkty->liczba_punktow -= 200;
                    $user->profile_theme = 'custom';
                    $user->save();
                } else {
                    return redirect()->back()->withErrors(['Nie masz wystarczającej liczby punktów na tę nagrodę.']);
                }
                break;
            default:
                return redirect()->back()->withErrors(['Wybrano nieprawidłową nagrodę.']);
        }

        $punkty->save();
        return redirect()->back()->with('success', 'Nagroda została wymieniona pomyślnie.');
    }
}

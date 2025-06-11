<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wymiany;
use App\Models\Ksiazki;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WymianyController extends Controller
{
    public function index()
    {
        $wymiany = Wymiany::all();
        return view('wymiany.list', ['wymiany' => $wymiany]);
    }

    public function create()
    {
        return view('wymiany.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ksiazka_id' => 'required|exists:ksiazki,id',
            'uzytkownik_id' => 'required|exists:uzytkownicy,id',
            'data' => 'required|date',
            'status' => 'required|string'
        ]);

        Wymiany::create($request->all());
        return redirect('wymiany');
    }

    public function show($id)
    {
        $wymiana = Wymiany::find($id);
        if (!$wymiana) {
            return view('wymiany.message', ['message' => "Wymiana o ID=$id nie została znaleziona.", 'type_of_message' => 'Error']);
        }
        return view('wymiany.show', ['wymiana' => $wymiana]);
    }

    public function edit($id)
    {
        $wymiana = Wymiany::find($id);
        if (!$wymiana) {
            return view('wymiany.message', ['message' => "Wymiana o ID=$id nie została znaleziona.", 'type_of_message' => 'Error']);
        }
        return view('wymiany.edit', ['wymiana' => $wymiana]);
    }

    public function update(Request $request, $id)
    {
        $wymiana = Wymiany::find($id);
        if ($wymiana) {
            $wymiana->update($request->all());
            return redirect('wymiany');
        }
        return view('wymiany.message', ['message' => "Wymiana o ID=$id nie została znaleziona.", 'type_of_message' => 'Error']);
    }

    public function destroy($id)
    {
        $wymiana = Wymiany::find($id);
        if ($wymiana) {
            $wymiana->delete();
            return redirect('wymiany');
        }
        return view('wymiany.message', ['message' => "Wymiana o ID=$id nie została znaleziona.", 'type_of_message' => 'Error']);
    }

    // Wymiana

    public function requestExchange(Request $request)
    {
        $request->validate([
            'book_id_a' => 'required|exists:ksiazki,id',
            'book_id_b' => 'required|exists:ksiazki,id',
        ]);

        Wymiany::create([
            'ksiazka_id' => $request->book_id_b,
            'uzytkownik_id' => auth()->id(),
            'offered_ksiazka_id' => $request->book_id_a,
            'requester_id' => auth()->id(),
            'recipient_id' => Ksiazki::findOrFail($request->book_id_b)->uzytkownik_id,
            'data' => now(),
            'status' => 'requested',
        ]);

        return redirect()->back()->with('success', 'Wysłano propozycję wymiany.');
    }

    public function acceptExchange($id)
    {
        $exchange = Wymiany::findOrFail($id);

        if ($exchange->recipient_id != auth()->id()) {
            return redirect()->back()->with('error', 'Nie masz uprawnień do tej wymiany!');
        }

        $exchange->update(['status' => 'accepted']);

        $exchange->ksiazka->update(['status' => 'niedostepna']);
        $exchange->offeredKsiazka->update(['status' => 'niedostepna']);

        $requester = User::find($exchange->requester_id);
        $recipient = User::find($exchange->recipient_id);

        if ($requester && $requester->punkty) {
            $requester->punkty->liczba_punktow += 5;
            $requester->punkty->save();
        }

        if ($recipient && $recipient->punkty) {
            $recipient->punkty->liczba_punktow += 5;
            $recipient->punkty->save();
        }

        return redirect()->back()->with('success', 'Wymiana zaakceptowana!');
    }

    public function denyExchange($id)
    {
        $exchange = Wymiany::findOrFail($id);

        if ($exchange->recipient_id != auth()->id()) {
            return redirect()->back()->with('error', 'Nie masz uprawnień do tej wymiany!');
        }

        $exchange->update(['status' => 'denied']);

        return redirect()->back()->with('success', 'Wymiana odrzucona.');
    }

    public function viewRequestExchange($book_id)
    {
        $books = Ksiazki::where('id', '!=', $book_id)->get();
        return view('exchange.request', ['books' => $books, 'book_id' => $book_id]);
    }

    public function viewPendingExchanges()
    {
        $pendingExchanges = Wymiany::where('status', 'requested')->get();
        return view('exchange.pending', ['pendingExchanges' => $pendingExchanges]);
    }

    public function getUserExchanges()
    {
        $user = Auth::user();
        $wymianyList = Wymiany::where('requester_id', $user->id)->orWhere('recipient_id', $user->id)->get();
        return $wymianyList;
    }
}

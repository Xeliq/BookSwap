<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ksiazki;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $ksiazki = Ksiazki::all();
        return view('home', ['ksiazki' => $ksiazki]);
        // return view('home');
    }

    public function zmienStanUwierzytelnienia()
    {
        if(auth()->check()){
            $user = auth()->user();
            Auth::logout();
            return view('wylogowano');
            }
        else{
            return redirect('/register');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

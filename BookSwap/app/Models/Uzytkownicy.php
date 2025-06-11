<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uzytkownicy extends Model
{
    public $timestamps = false;
    protected $table = 'uzytkownicy';
    //Klucz główny
    protected $primaryKey = 'id';
    //Pola, które mogą być wypełniane masowo
    protected $fillable = ['login','haslo','email','rola'];

    //Relacja z modelami Ksiazki
    public function ksiazki()
    {
        return $this->hasMany(Ksiazki::class, 'uzytkownik_id');
    }

    //Relacja z modelem Punkty
    public function punkty()
    {
        return $this->hasOne(Punkty::class, 'uzytkownik_id');
    }

    //Relacja z modelami Wiadomosci (nadawca)
    public function wyslaneWiadomosci()
    {
        return $this->hasMany(Wiadomosci::class, 'nadawca_id');
    }

    //Relacja z modelami Wiadomosci (odbiorca)
    public function otrzymaneWiadomosci()
    {
        return $this->hasMany(Wiadomosci::class, 'odbiorca_id');
    }

    //Relacja z modelami Wymiany
    public function wymiany()
    {
        return $this->hasMany(Wymiany::class, 'uzytkownik_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wymiany extends Model
{
    public $timestamps = false;
    protected $table = 'wymiany';
    //Klucz główny
    protected $primaryKey = 'id';
    //Pola, które mogą być wypełniane masowo
    // protected $fillable = ['ksiazka_id', 'uzytkownik_id', 'data', 'status'];
    protected $fillable = ['ksiazka_id', 'uzytkownik_id', 'offered_ksiazka_id', 'requester_id', 'recipient_id', 'data', 'status'];

    //Relacja z modelem Ksiazki
    public function ksiazka()
    {
        return $this->belongsTo(Ksiazki::class, 'ksiazka_id');
    }

    public function offeredKsiazka()
    {
        return $this->belongsTo(Ksiazki::class, 'offered_ksiazka_id');
    }

    //Relacja z modelem User
    public function uzytkownik()
    {
        return $this->belongsTo(User::class, 'uzytkownik_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}

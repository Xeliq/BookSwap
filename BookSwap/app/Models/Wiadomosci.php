<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wiadomosci extends Model
{
    public $timestamps = false;
    protected $table = 'wiadomosci';
    //Klucz główny
    protected $primaryKey = 'id';
    //Pola, które mogą być wypełniane masowo
    protected $fillable = ['nadawca_id', 'odbiorca_id', 'tresc', 'data'];

    //Relacja z modelem User (nadawca)
    public function nadawca()
    {
        return $this->belongsTo(User::class, 'nadawca_id');
    }

    //Relacja z modelem User (odbiorca)
    public function odbiorca()
    {
        return $this->belongsTo(User::class, 'odbiorca_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ksiazki extends Model
{
    public $timestamps = false;
    protected $table = 'ksiazki';
    //Klucz główny
    protected $primaryKey = 'id';
    //Pola, które mogą być wypełniane masowo
    protected $fillable = ['tytul', 'autor', 'gatunek', 'zdjecie', 'uzytkownik_id', 'status'];

    //Relacja z modelem User
    public function uzytkownik()
    {
        return $this->belongsTo(User::class, 'uzytkownik_id');
    }
}

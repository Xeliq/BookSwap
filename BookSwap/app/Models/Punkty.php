<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Punkty extends Model
{
    public $timestamps = false;
    protected $table = 'punkty';
    //Klucz główny
    protected $primaryKey = 'id';
    //Pola, które mogą być wypełniane masowo
    protected $fillable = ['uzytkownik_id', 'liczba_punktow'];

    //Relacja z modelem User
    public function uzytkownik()
    {
        return $this->belongsTo(User::class, 'uzytkownik_id');
    }
}

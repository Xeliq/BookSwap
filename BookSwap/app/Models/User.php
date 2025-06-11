<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    protected $table = 'users';
    //Klucz główny
    protected $primaryKey = 'id';
    //Pola, które mogą być wypełniane masowo
    // protected $fillable = ['login','haslo','email','rola'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rola',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->rola === 'ADMIN';
    }

    public function isUser()
    {
        return $this->rola === 'USER';
    }

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

    //Relacja z modelami Wiadomosci (odebrane)
    public function wiadomosciOdebrane()
    {
        return $this->hasMany(Wiadomosci::class, 'odbiorca_id');
    }

    //Relacja z modelami Wiadomosci (wyslane)
    public function wiadomosciWyslane()
    {
        return $this->hasMany(Wiadomosci::class, 'nadawca_id');
    }
}

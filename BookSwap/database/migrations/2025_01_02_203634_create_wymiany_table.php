<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWymianyTable extends Migration
{
    public function up()
    {
        Schema::create('wymiany', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ksiazka_id')->constrained('ksiazki')->onDelete('cascade');
            $table->foreignId('uzytkownik_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('offered_ksiazka_id')->constrained('ksiazki')->onDelete('cascade');
            $table->foreignId('requester_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('recipient_id')->constrained('users')->onDelete('cascade');
            $table->date('data');
            $table->string('status')->default('requested');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wymiany');
    }
}

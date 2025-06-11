<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ksiazki', function (Blueprint $table) {
            $table->id();
            $table->string('tytul');
            $table->string('autor');
            $table->string('gatunek');
            $table->text('zdjecie')->nullable();
            $table->foreignId('uzytkownik_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('dostepna');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ksiazki');
    }
};

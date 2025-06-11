<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wiadomosci', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nadawca_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('odbiorca_id')->constrained('users')->onDelete('cascade');
            $table->text('tresc');
            $table->timestamp('data')->default(now());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wiadomosci');
    }
};

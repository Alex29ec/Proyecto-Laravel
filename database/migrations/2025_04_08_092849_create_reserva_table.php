<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_tatuador')->constrained('tatuadors')->onDelete('cascade');
            $table->string('image');
            $table->date('date');
            $table->string('hour');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
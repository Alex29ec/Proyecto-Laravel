<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idtatuador')->references('id')->on('tatuadors')->onDelete('cascade');
            $table->string('ruta'); 
            $table->string('estilo');
            $table->enum('zona', ['manos', 'brazos','antebrazos', 'pierna', 'pecho', 'cabeza','espalda', 'gemelos']);
            $table->enum('tamano', ['pequeño', 'mediano', 'grande']);
            $table->timestamps();
 });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};

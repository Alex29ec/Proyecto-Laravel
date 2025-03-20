<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('telefonos', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clave foránea
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('telefonos');
    }
};

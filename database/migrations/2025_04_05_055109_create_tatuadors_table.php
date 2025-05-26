<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tatuadors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->text('specialties'); 
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tatuadores');
    }
};
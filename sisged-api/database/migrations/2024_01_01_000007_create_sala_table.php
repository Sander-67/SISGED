<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sala', function (Blueprint $table) {
            $table->id('idSala');
            $table->unsignedBigInteger('Aula_idAula')->nullable();
            $table->string('nomeSala', 50)->nullable();
            $table->integer('capacidadeSala')->nullable();
            $table->string('tipoAula', 50)->nullable();
            $table->string('blocoandarAula', 50)->nullable();
            $table->timestamps();

            $table->foreign('Aula_idAula')->references('idAula')->on('aula');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sala');
    }
};

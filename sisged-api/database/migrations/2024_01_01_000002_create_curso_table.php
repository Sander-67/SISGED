<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curso', function (Blueprint $table) {
            $table->id('idCurso');
            $table->unsignedBigInteger('Turma_idTurma')->nullable();
            $table->string('nomeCurso', 100)->nullable();
            $table->string('modalidadeCurso', 50)->nullable();
            $table->integer('cargahorariaCurso')->nullable();
            $table->integer('nivelCurso')->nullable();
            $table->timestamps();

            $table->foreign('Turma_idTurma')->references('idTurma')->on('turma');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso');
    }
};

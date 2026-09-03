<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aula', function (Blueprint $table) {
            $table->id('idAula');
            $table->unsignedBigInteger('Administrador_idAdministrador')->nullable();
            $table->unsignedBigInteger('Aluno_idAluno')->nullable();
            $table->unsignedBigInteger('Materia_idMateria')->nullable();
            $table->unsignedBigInteger('Turma_idTurma')->nullable();
            $table->date('dataAula')->nullable();
            $table->time('horarioinicioAula')->nullable();
            $table->time('horariofimAula')->nullable();
            $table->time('duracaoAula')->nullable();
            $table->string('tipoAula', 50)->nullable();
            $table->boolean('statusAula')->default(true);
            $table->timestamps();

            $table->foreign('Administrador_idAdministrador')->references('idAdministrador')->on('administrador');
            $table->foreign('Aluno_idAluno')->references('idAluno')->on('aluno');
            $table->foreign('Materia_idMateria')->references('idMateria')->on('materia');
            $table->foreign('Turma_idTurma')->references('idTurma')->on('turma');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aula');
    }
};

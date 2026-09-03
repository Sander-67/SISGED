<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turma', function (Blueprint $table) {
            $table->id('idTurma');
            $table->integer('codigoTurma')->nullable();
            $table->string('turnoTurma', 50)->nullable();
            $table->date('datainicioTurma')->nullable();
            $table->date('datafimTurma')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turma');
    }
};

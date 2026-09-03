<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instrutor', function (Blueprint $table) {
            $table->id('idInstrutor');
            $table->unsignedBigInteger('Aula_idAula')->nullable();
            $table->string('nomeInstrutor', 100)->nullable();
            $table->unsignedBigInteger('cpfInstrutor')->nullable();
            $table->string('emailInstrutor', 100)->nullable();
            $table->unsignedBigInteger('telefoneInstrutor')->nullable();
            $table->string('areaInstrutor', 50)->nullable();
            $table->boolean('statusInstrutor')->default(true);
            $table->timestamps();

            $table->foreign('Aula_idAula')->references('idAula')->on('aula');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instrutor');
    }
};

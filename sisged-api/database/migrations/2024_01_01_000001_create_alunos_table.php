<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aluno', function (Blueprint $table) {
            $table->id('idAluno');
            $table->string('nomeAluno', 100);
            $table->unsignedBigInteger('cpfAluno')->unique();
            $table->string('emailAluno', 100)->unique();
            $table->unsignedBigInteger('telefoneAluno')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aluno');
    }
};

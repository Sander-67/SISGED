<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materia', function (Blueprint $table) {
            $table->id('idMateria');
            $table->string('siglaMateria', 20)->nullable();
            $table->string('nomeMateria', 100)->nullable();
            $table->time('cargahorariaMateria')->nullable();
            $table->string('ementaMateria', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materia');
    }
};

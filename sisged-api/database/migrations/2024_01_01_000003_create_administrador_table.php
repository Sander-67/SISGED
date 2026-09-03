<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('administrador', function (Blueprint $table) {
            $table->id('idAdministrador');
            $table->string('usuarioAdministrador', 50)->nullable();
            $table->string('emailAdministrador', 100)->unique()->nullable();
            $table->string('senhaAdministrador', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('administrador');
    }
};

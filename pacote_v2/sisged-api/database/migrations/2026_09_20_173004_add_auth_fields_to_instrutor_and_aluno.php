<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instrutor', function (Blueprint $table) {
            $table->string('senhaInstrutor', 255)->nullable()->after('areaInstrutor');
            $table->boolean('deve_trocar_senha')->default(true)->after('senhaInstrutor');
        });

        Schema::table('aluno', function (Blueprint $table) {
            $table->boolean('deve_trocar_senha')->default(true)->after('senhaAluno');
        });
    }

    public function down(): void
    {
        Schema::table('instrutor', function (Blueprint $table) {
            $table->dropColumn(['senhaInstrutor', 'deve_trocar_senha']);
        });

        Schema::table('aluno', function (Blueprint $table) {
            $table->dropColumn('deve_trocar_senha');
        });
    }
};

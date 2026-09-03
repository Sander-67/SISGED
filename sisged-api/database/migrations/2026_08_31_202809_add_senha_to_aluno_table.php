<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('Aluno', function (Blueprint $table) {
            $table->string('senhaAluno')->nullable()->after('telefoneAluno');
        });
    }

    public function down(): void
    {
        Schema::table('Aluno', function (Blueprint $table) {
            $table->dropColumn('senhaAluno');
        });
    }
};
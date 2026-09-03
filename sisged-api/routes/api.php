<?php

use App\Http\Controllers\Api\AdministradorController;
use App\Http\Controllers\Api\AlunoController;
use App\Http\Controllers\Api\AulaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\Api\InstrutorController;
use App\Http\Controllers\Api\MateriaController;
use App\Http\Controllers\Api\SalaController;
use App\Http\Controllers\Api\TurmaController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Rotas de login (públicas, sem autenticação)
    Route::post('auth/administrador/login', [AuthController::class, 'loginAdministrador']);
    Route::post('auth/aluno/login', [AuthController::class, 'loginAluno']);
    Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    // Rota do Aluno: só pode ver os nomes dos cursos
    Route::middleware(['auth:sanctum', 'tipo:aluno'])->group(function () {
        Route::get('aluno/cursos', [CursoController::class, 'nomes']);
    });

    // Rotas do Administrador: acesso total (CRUD completo)
    Route::middleware(['auth:sanctum', 'tipo:administrador'])->group(function () {
        Route::apiResource('alunos', AlunoController::class)->parameters(['alunos' => 'aluno']);
        Route::apiResource('turmas', TurmaController::class)->parameters(['turmas' => 'turma']);
        Route::apiResource('cursos', CursoController::class)->parameters(['cursos' => 'curso']);
        Route::apiResource('administradores', AdministradorController::class)->parameters(['administradores' => 'administrador']);
        Route::apiResource('materias', MateriaController::class)->parameters(['materias' => 'materia']);
        Route::apiResource('aulas', AulaController::class)->parameters(['aulas' => 'aula']);
        Route::apiResource('instrutores', InstrutorController::class)->parameters(['instrutores' => 'instrutor']);
        Route::apiResource('salas', SalaController::class)->parameters(['salas' => 'sala']);
    });
});
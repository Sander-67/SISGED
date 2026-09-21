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

    // Rotas de login (públicas, sem autenticação, mas com limite de tentativas)
    Route::middleware('throttle:5,1')->group(function () {
        Route::post('auth/administrador/login', [AuthController::class, 'loginAdministrador']);
        Route::post('auth/aluno/login', [AuthController::class, 'loginAluno']);
        Route::post('auth/instrutor/login', [AuthController::class, 'loginInstrutor']);
    });

    // Rotas liberadas pra qualquer usuário autenticado, mesmo que
    // ainda esteja com a senha padrão (senão ele fica travado sem
    // conseguir sair ou trocar a própria senha).
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('auth/logout', [AuthController::class, 'logout']);
        Route::post('auth/trocar-senha', [AuthController::class, 'trocarSenha']);
    });

    // Rotas de CONSULTA (somente leitura), liberadas para qualquer
    // usuário autenticado (Aluno, Instrutor ou Administrador), desde
    // que já tenha trocado a senha padrão. É aqui que entram os
    // filtros de pesquisa (por data, instrutor e sala).
    Route::middleware(['auth:sanctum', 'senha.trocar'])->group(function () {
        Route::get('aulas', [AulaController::class, 'index']);
        Route::get('aulas/{aula}', [AulaController::class, 'show']);
        Route::get('instrutores', [InstrutorController::class, 'index']);
        Route::get('instrutores/{instrutor}', [InstrutorController::class, 'show']);
        Route::get('salas', [SalaController::class, 'index']);
        Route::get('salas/{sala}', [SalaController::class, 'show']);
        Route::get('turmas', [TurmaController::class, 'index']);
        Route::get('turmas/{turma}', [TurmaController::class, 'show']);
    });

    // Rota do Aluno: além das consultas acima, pode ver os nomes dos cursos.
    Route::middleware(['auth:sanctum', 'senha.trocar', 'tipo:aluno'])->group(function () {
        Route::get('aluno/cursos', [CursoController::class, 'nomes']);
    });

    // Rotas do Instrutor: acesso às próprias aulas.
    Route::middleware(['auth:sanctum', 'senha.trocar', 'tipo:instrutor'])->group(function () {
        Route::get('instrutor/minhas-aulas', [AulaController::class, 'minhasAulas']);
    });

    // Rotas do Administrador: CRUD completo (criar, editar, apagar).
    // As rotas de "index"/"show" de aulas, instrutores, salas e turmas
    // já foram liberadas acima pra todo mundo, então usamos "except"
    // aqui pra não duplicar e não sobrescrever a regra de permissão.
    Route::middleware(['auth:sanctum', 'senha.trocar', 'tipo:administrador'])->group(function () {
        Route::apiResource('alunos', AlunoController::class)->parameters(['alunos' => 'aluno']);
        Route::apiResource('cursos', CursoController::class)->parameters(['cursos' => 'curso']);
        Route::apiResource('administradores', AdministradorController::class)->parameters(['administradores' => 'administrador']);
        Route::apiResource('materias', MateriaController::class)->parameters(['materias' => 'materia']);

        Route::apiResource('aulas', AulaController::class)
            ->parameters(['aulas' => 'aula'])
            ->except(['index', 'show']);

        Route::apiResource('instrutores', InstrutorController::class)
            ->parameters(['instrutores' => 'instrutor'])
            ->except(['index', 'show']);

        Route::apiResource('salas', SalaController::class)
            ->parameters(['salas' => 'sala'])
            ->except(['index', 'show']);

        Route::apiResource('turmas', TurmaController::class)
            ->parameters(['turmas' => 'turma'])
            ->except(['index', 'show']);
    });
});

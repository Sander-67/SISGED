<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="SISGED API",
 *     version="1.0.0",
 *     description="API REST do sistema SISGED. Documentação gerada com L5-Swagger (OpenAPI 3).",
 *     @OA\Contact(email="contato@sisged.com.br")
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Servidor da API"
 * )
 *
 * @OA\Tag(name="Alunos", description="Endpoints para gerenciamento (CRUD) de alunos")
 * @OA\Tag(name="Turmas", description="Endpoints para gerenciamento (CRUD) de turmas")
 * @OA\Tag(name="Cursos", description="Endpoints para gerenciamento (CRUD) de cursos")
 * @OA\Tag(name="Administradores", description="Endpoints para gerenciamento (CRUD) de administradores")
 * @OA\Tag(name="Materias", description="Endpoints para gerenciamento (CRUD) de matérias")
 * @OA\Tag(name="Aulas", description="Endpoints para gerenciamento (CRUD) de aulas")
 * @OA\Tag(name="Instrutores", description="Endpoints para gerenciamento (CRUD) de instrutores")
 * @OA\Tag(name="Salas", description="Endpoints para gerenciamento (CRUD) de salas")
 */
abstract class Controller
{
    //
}
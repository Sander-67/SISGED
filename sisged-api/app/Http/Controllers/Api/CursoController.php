<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;
use App\Http\Resources\CursoResource;
use App\Models\Curso;
use Illuminate\Http\JsonResponse;

class CursoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/cursos",
     *     tags={"Cursos"},
     *     summary="Lista todos os cursos",
     *     @OA\Response(response=200, description="Lista de cursos", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Curso")))
     * )
     */
    public function index(): JsonResponse
    {
        $cursos = Curso::orderBy('idCurso')->paginate(request('per_page', 15));
        return response()->json(CursoResource::collection($cursos)->response()->getData(true));
    }

       /**
     * @OA\Get(
     *     path="/aluno/cursos",
     *     tags={"Cursos"},
     *     summary="Lista somente o nome dos cursos (acesso do aluno)",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Lista de nomes de cursos")
     * )
     */
    public function nomes(): JsonResponse
    {
        return response()->json(
            Curso::select('idCurso', 'nomeCurso')->get()
        );
    }

    /**
     * @OA\Post(
     *     path="/cursos",
     *     tags={"Cursos"},
     *     summary="Cadastra um novo curso",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Curso")),
     *     @OA\Response(response=201, description="Curso criado", @OA\JsonContent(ref="#/components/schemas/Curso")),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function store(StoreCursoRequest $request): JsonResponse
    {
        $curso = Curso::create($request->validated());
        return (new CursoResource($curso))->response()->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *     path="/cursos/{idCurso}",
     *     tags={"Cursos"},
     *     summary="Exibe um curso específico",
     *     @OA\Parameter(name="idCurso", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Curso encontrado", @OA\JsonContent(ref="#/components/schemas/Curso")),
     *     @OA\Response(response=404, description="Curso não encontrado")
     * )
     */
    public function show(Curso $curso): CursoResource
    {
        return new CursoResource($curso);
    }

    /**
     * @OA\Put(
     *     path="/cursos/{idCurso}",
     *     tags={"Cursos"},
     *     summary="Atualiza um curso",
     *     @OA\Parameter(name="idCurso", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Curso")),
     *     @OA\Response(response=200, description="Curso atualizado", @OA\JsonContent(ref="#/components/schemas/Curso")),
     *     @OA\Response(response=404, description="Curso não encontrado"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function update(UpdateCursoRequest $request, Curso $curso): CursoResource
    {
        $curso->update($request->validated());
        return new CursoResource($curso);
    }

    /**
     * @OA\Delete(
     *     path="/cursos/{idCurso}",
     *     tags={"Cursos"},
     *     summary="Remove um curso",
     *     @OA\Parameter(name="idCurso", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Curso removido"),
     *     @OA\Response(response=404, description="Curso não encontrado")
     * )
     */
    public function destroy(Curso $curso): JsonResponse
    {
        $curso->delete();
        return response()->json(null, 204);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTurmaRequest;
use App\Http\Requests\UpdateTurmaRequest;
use App\Http\Resources\TurmaResource;
use App\Models\Turma;
use Illuminate\Http\JsonResponse;

class TurmaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/turmas",
     *     tags={"Turmas"},
     *     summary="Lista todas as turmas",
     *     @OA\Response(response=200, description="Lista de turmas", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Turma")))
     * )
     */
    public function index(): JsonResponse
    {
        $turmas = Turma::orderBy('idTurma')->paginate(request('per_page', 15));
        return response()->json(TurmaResource::collection($turmas)->response()->getData(true));
    }

    /**
     * @OA\Post(
     *     path="/turmas",
     *     tags={"Turmas"},
     *     summary="Cadastra uma nova turma",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Turma")),
     *     @OA\Response(response=201, description="Turma criada", @OA\JsonContent(ref="#/components/schemas/Turma")),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function store(StoreTurmaRequest $request): JsonResponse
    {
        $turma = Turma::create($request->validated());
        return (new TurmaResource($turma))->response()->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *     path="/turmas/{idTurma}",
     *     tags={"Turmas"},
     *     summary="Exibe uma turma específica",
     *     @OA\Parameter(name="idTurma", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Turma encontrada", @OA\JsonContent(ref="#/components/schemas/Turma")),
     *     @OA\Response(response=404, description="Turma não encontrada")
     * )
     */
    public function show(Turma $turma): TurmaResource
    {
        return new TurmaResource($turma);
    }

    /**
     * @OA\Put(
     *     path="/turmas/{idTurma}",
     *     tags={"Turmas"},
     *     summary="Atualiza uma turma",
     *     @OA\Parameter(name="idTurma", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Turma")),
     *     @OA\Response(response=200, description="Turma atualizada", @OA\JsonContent(ref="#/components/schemas/Turma")),
     *     @OA\Response(response=404, description="Turma não encontrada"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function update(UpdateTurmaRequest $request, Turma $turma): TurmaResource
    {
        $turma->update($request->validated());
        return new TurmaResource($turma);
    }

    /**
     * @OA\Delete(
     *     path="/turmas/{idTurma}",
     *     tags={"Turmas"},
     *     summary="Remove uma turma",
     *     @OA\Parameter(name="idTurma", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Turma removida"),
     *     @OA\Response(response=404, description="Turma não encontrada")
     * )
     */
    public function destroy(Turma $turma): JsonResponse
    {
        $turma->delete();
        return response()->json(null, 204);
    }
}

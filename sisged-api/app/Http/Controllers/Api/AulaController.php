<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAulaRequest;
use App\Http\Requests\UpdateAulaRequest;
use App\Http\Resources\AulaResource;
use App\Models\Aula;
use Illuminate\Http\JsonResponse;

class AulaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/aulas",
     *     tags={"Aulas"},
     *     summary="Lista todas as aulas",
     *     @OA\Response(response=200, description="Lista de aulas", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Aula")))
     * )
     */
    public function index(): JsonResponse
    {
        $aulas = Aula::orderBy('dataAula', 'desc')->paginate(request('per_page', 15));
        return response()->json(AulaResource::collection($aulas)->response()->getData(true));
    }

    /**
     * @OA\Post(
     *     path="/aulas",
     *     tags={"Aulas"},
     *     summary="Cadastra uma nova aula",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Aula")),
     *     @OA\Response(response=201, description="Aula criada", @OA\JsonContent(ref="#/components/schemas/Aula")),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function store(StoreAulaRequest $request): JsonResponse
    {
        $aula = Aula::create($request->validated());
        return (new AulaResource($aula))->response()->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *     path="/aulas/{idAula}",
     *     tags={"Aulas"},
     *     summary="Exibe uma aula específica",
     *     @OA\Parameter(name="idAula", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Aula encontrada", @OA\JsonContent(ref="#/components/schemas/Aula")),
     *     @OA\Response(response=404, description="Aula não encontrada")
     * )
     */
    public function show(Aula $aula): AulaResource
    {
        return new AulaResource($aula);
    }

    /**
     * @OA\Put(
     *     path="/aulas/{idAula}",
     *     tags={"Aulas"},
     *     summary="Atualiza uma aula",
     *     @OA\Parameter(name="idAula", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Aula")),
     *     @OA\Response(response=200, description="Aula atualizada", @OA\JsonContent(ref="#/components/schemas/Aula")),
     *     @OA\Response(response=404, description="Aula não encontrada"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function update(UpdateAulaRequest $request, Aula $aula): AulaResource
    {
        $aula->update($request->validated());
        return new AulaResource($aula);
    }

    /**
     * @OA\Delete(
     *     path="/aulas/{idAula}",
     *     tags={"Aulas"},
     *     summary="Remove uma aula",
     *     @OA\Parameter(name="idAula", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Aula removida"),
     *     @OA\Response(response=404, description="Aula não encontrada")
     * )
     */
    public function destroy(Aula $aula): JsonResponse
    {
        $aula->delete();
        return response()->json(null, 204);
    }
}

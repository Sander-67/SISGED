<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalaRequest;
use App\Http\Requests\UpdateSalaRequest;
use App\Http\Resources\SalaResource;
use App\Models\Sala;
use Illuminate\Http\JsonResponse;

class SalaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/salas",
     *     tags={"Salas"},
     *     summary="Lista todas as salas",
     *     @OA\Response(response=200, description="Lista de salas", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Sala")))
     * )
     */
    public function index(): JsonResponse
    {
        $salas = Sala::orderBy('nomeSala')->paginate(request('per_page', 15));
        return response()->json(SalaResource::collection($salas)->response()->getData(true));
    }

    /**
     * @OA\Post(
     *     path="/salas",
     *     tags={"Salas"},
     *     summary="Cadastra uma nova sala",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Sala")),
     *     @OA\Response(response=201, description="Sala criada", @OA\JsonContent(ref="#/components/schemas/Sala")),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function store(StoreSalaRequest $request): JsonResponse
    {
        $sala = Sala::create($request->validated());
        return (new SalaResource($sala))->response()->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *     path="/salas/{idSala}",
     *     tags={"Salas"},
     *     summary="Exibe uma sala específica",
     *     @OA\Parameter(name="idSala", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Sala encontrada", @OA\JsonContent(ref="#/components/schemas/Sala")),
     *     @OA\Response(response=404, description="Sala não encontrada")
     * )
     */
    public function show(Sala $sala): SalaResource
    {
        return new SalaResource($sala);
    }

    /**
     * @OA\Put(
     *     path="/salas/{idSala}",
     *     tags={"Salas"},
     *     summary="Atualiza uma sala",
     *     @OA\Parameter(name="idSala", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Sala")),
     *     @OA\Response(response=200, description="Sala atualizada", @OA\JsonContent(ref="#/components/schemas/Sala")),
     *     @OA\Response(response=404, description="Sala não encontrada"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function update(UpdateSalaRequest $request, Sala $sala): SalaResource
    {
        $sala->update($request->validated());
        return new SalaResource($sala);
    }

    /**
     * @OA\Delete(
     *     path="/salas/{idSala}",
     *     tags={"Salas"},
     *     summary="Remove uma sala",
     *     @OA\Parameter(name="idSala", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Sala removida"),
     *     @OA\Response(response=404, description="Sala não encontrada")
     * )
     */
    public function destroy(Sala $sala): JsonResponse
    {
        $sala->delete();
        return response()->json(null, 204);
    }
}

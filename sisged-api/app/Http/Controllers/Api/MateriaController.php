<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMateriaRequest;
use App\Http\Requests\UpdateMateriaRequest;
use App\Http\Resources\MateriaResource;
use App\Models\Materia;
use Illuminate\Http\JsonResponse;

class MateriaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/materias",
     *     tags={"Materias"},
     *     summary="Lista todas as matérias",
     *     @OA\Response(response=200, description="Lista de matérias", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Materia")))
     * )
     */
    public function index(): JsonResponse
    {
        $materias = Materia::orderBy('idMateria')->paginate(request('per_page', 15));
        return response()->json(MateriaResource::collection($materias)->response()->getData(true));
    }

    /**
     * @OA\Post(
     *     path="/materias",
     *     tags={"Materias"},
     *     summary="Cadastra uma nova matéria",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Materia")),
     *     @OA\Response(response=201, description="Matéria criada", @OA\JsonContent(ref="#/components/schemas/Materia")),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function store(StoreMateriaRequest $request): JsonResponse
    {
        $materia = Materia::create($request->validated());
        return (new MateriaResource($materia))->response()->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *     path="/materias/{idMateria}",
     *     tags={"Materias"},
     *     summary="Exibe uma matéria específica",
     *     @OA\Parameter(name="idMateria", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Matéria encontrada", @OA\JsonContent(ref="#/components/schemas/Materia")),
     *     @OA\Response(response=404, description="Matéria não encontrada")
     * )
     */
    public function show(Materia $materia): MateriaResource
    {
        return new MateriaResource($materia);
    }

    /**
     * @OA\Put(
     *     path="/materias/{idMateria}",
     *     tags={"Materias"},
     *     summary="Atualiza uma matéria",
     *     @OA\Parameter(name="idMateria", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Materia")),
     *     @OA\Response(response=200, description="Matéria atualizada", @OA\JsonContent(ref="#/components/schemas/Materia")),
     *     @OA\Response(response=404, description="Matéria não encontrada"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function update(UpdateMateriaRequest $request, Materia $materia): MateriaResource
    {
        $materia->update($request->validated());
        return new MateriaResource($materia);
    }

    /**
     * @OA\Delete(
     *     path="/materias/{idMateria}",
     *     tags={"Materias"},
     *     summary="Remove uma matéria",
     *     @OA\Parameter(name="idMateria", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Matéria removida"),
     *     @OA\Response(response=404, description="Matéria não encontrada")
     * )
     */
    public function destroy(Materia $materia): JsonResponse
    {
        $materia->delete();
        return response()->json(null, 204);
    }
}

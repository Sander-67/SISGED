<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstrutorRequest;
use App\Http\Requests\UpdateInstrutorRequest;
use App\Http\Resources\InstrutorResource;
use App\Models\Instrutor;
use Illuminate\Http\JsonResponse;

class InstrutorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/instrutores",
     *     tags={"Instrutores"},
     *     summary="Lista todos os instrutores",
     *     @OA\Response(response=200, description="Lista de instrutores", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Instrutor")))
     * )
     */
    public function index(): JsonResponse
    {
        $instrutores = Instrutor::orderBy('nomeInstrutor')->paginate(request('per_page', 15));
        return response()->json(InstrutorResource::collection($instrutores)->response()->getData(true));
    }

    /**
     * @OA\Post(
     *     path="/instrutores",
     *     tags={"Instrutores"},
     *     summary="Cadastra um novo instrutor",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Instrutor")),
     *     @OA\Response(response=201, description="Instrutor criado", @OA\JsonContent(ref="#/components/schemas/Instrutor")),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function store(StoreInstrutorRequest $request): JsonResponse
    {
        $instrutor = Instrutor::create($request->validated());
        return (new InstrutorResource($instrutor))->response()->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *     path="/instrutores/{idInstrutor}",
     *     tags={"Instrutores"},
     *     summary="Exibe um instrutor específico",
     *     @OA\Parameter(name="idInstrutor", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Instrutor encontrado", @OA\JsonContent(ref="#/components/schemas/Instrutor")),
     *     @OA\Response(response=404, description="Instrutor não encontrado")
     * )
     */
    public function show(Instrutor $instrutor): InstrutorResource
    {
        return new InstrutorResource($instrutor);
    }

    /**
     * @OA\Put(
     *     path="/instrutores/{idInstrutor}",
     *     tags={"Instrutores"},
     *     summary="Atualiza um instrutor",
     *     @OA\Parameter(name="idInstrutor", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Instrutor")),
     *     @OA\Response(response=200, description="Instrutor atualizado", @OA\JsonContent(ref="#/components/schemas/Instrutor")),
     *     @OA\Response(response=404, description="Instrutor não encontrado"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function update(UpdateInstrutorRequest $request, Instrutor $instrutor): InstrutorResource
    {
        $instrutor->update($request->validated());
        return new InstrutorResource($instrutor);
    }

    /**
     * @OA\Delete(
     *     path="/instrutores/{idInstrutor}",
     *     tags={"Instrutores"},
     *     summary="Remove um instrutor",
     *     @OA\Parameter(name="idInstrutor", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Instrutor removido"),
     *     @OA\Response(response=404, description="Instrutor não encontrado")
     * )
     */
    public function destroy(Instrutor $instrutor): JsonResponse
    {
        $instrutor->delete();
        return response()->json(null, 204);
    }
}

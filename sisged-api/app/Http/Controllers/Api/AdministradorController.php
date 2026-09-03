<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdministradorRequest;
use App\Http\Requests\UpdateAdministradorRequest;
use App\Http\Resources\AdministradorResource;
use App\Models\Administrador;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/administradores",
     *     tags={"Administradores"},
     *     summary="Lista todos os administradores",
     *     @OA\Response(response=200, description="Lista de administradores", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Administrador")))
     * )
     */
    public function index(): JsonResponse
    {
        $administradores = Administrador::orderBy('idAdministrador')->paginate(request('per_page', 15));
        return response()->json(AdministradorResource::collection($administradores)->response()->getData(true));
    }

    /**
     * @OA\Post(
     *     path="/administradores",
     *     tags={"Administradores"},
     *     summary="Cadastra um novo administrador",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Administrador")),
     *     @OA\Response(response=201, description="Administrador criado", @OA\JsonContent(ref="#/components/schemas/Administrador")),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function store(StoreAdministradorRequest $request): JsonResponse
    {
        $dados = $request->validated();
        $dados['senhaAdministrador'] = Hash::make($dados['senhaAdministrador']);

        $administrador = Administrador::create($dados);
        return (new AdministradorResource($administrador))->response()->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *     path="/administradores/{idAdministrador}",
     *     tags={"Administradores"},
     *     summary="Exibe um administrador específico",
     *     @OA\Parameter(name="idAdministrador", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Administrador encontrado", @OA\JsonContent(ref="#/components/schemas/Administrador")),
     *     @OA\Response(response=404, description="Administrador não encontrado")
     * )
     */
    public function show(Administrador $administrador): AdministradorResource
    {
        return new AdministradorResource($administrador);
    }

    /**
     * @OA\Put(
     *     path="/administradores/{idAdministrador}",
     *     tags={"Administradores"},
     *     summary="Atualiza um administrador",
     *     @OA\Parameter(name="idAdministrador", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Administrador")),
     *     @OA\Response(response=200, description="Administrador atualizado", @OA\JsonContent(ref="#/components/schemas/Administrador")),
     *     @OA\Response(response=404, description="Administrador não encontrado"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function update(UpdateAdministradorRequest $request, Administrador $administrador): AdministradorResource
    {
        $dados = $request->validated();
        if (isset($dados['senhaAdministrador'])) {
            $dados['senhaAdministrador'] = Hash::make($dados['senhaAdministrador']);
        }

        $administrador->update($dados);
        return new AdministradorResource($administrador);
    }

    /**
     * @OA\Delete(
     *     path="/administradores/{idAdministrador}",
     *     tags={"Administradores"},
     *     summary="Remove um administrador",
     *     @OA\Parameter(name="idAdministrador", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Administrador removido"),
     *     @OA\Response(response=404, description="Administrador não encontrado")
     * )
     */
    public function destroy(Administrador $administrador): JsonResponse
    {
        $administrador->delete();
        return response()->json(null, 204);
    }
}

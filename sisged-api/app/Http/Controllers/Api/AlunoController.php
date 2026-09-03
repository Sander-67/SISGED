<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlunoRequest;
use App\Http\Requests\UpdateAlunoRequest;
use App\Http\Resources\AlunoResource;
use App\Models\Aluno;
use Illuminate\Http\JsonResponse;

class AlunoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/alunos",
     *     tags={"Alunos"},
     *     summary="Lista todos os alunos",
     *     description="Retorna uma lista paginada de alunos cadastrados",
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Quantidade de registros por página",
     *         required=false,
     *         @OA\Schema(type="integer", example=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de alunos retornada com sucesso",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Aluno")
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $alunos = Aluno::orderBy('nomeAluno')->paginate(request('per_page', 15));

        return response()->json(AlunoResource::collection($alunos)->response()->getData(true));
    }

    /**
     * @OA\Post(
     *     path="/alunos",
     *     tags={"Alunos"},
     *     summary="Cadastra um novo aluno",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nomeAluno","cpfAluno","emailAluno"},
     *             @OA\Property(property="nomeAluno", type="string", example="Maria Silva"),
     *             @OA\Property(property="cpfAluno", type="integer", example=12345678900),
     *             @OA\Property(property="emailAluno", type="string", example="maria.silva@email.com"),
     *             @OA\Property(property="telefoneAluno", type="integer", example=31998765432)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Aluno criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Aluno")
     *     ),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function store(StoreAlunoRequest $request): JsonResponse
    {
        $aluno = Aluno::create($request->validated());

        return (new AlunoResource($aluno))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *     path="/alunos/{idAluno}",
     *     tags={"Alunos"},
     *     summary="Exibe os dados de um aluno específico",
     *     @OA\Parameter(
     *         name="idAluno",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Aluno encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/Aluno")
     *     ),
     *     @OA\Response(response=404, description="Aluno não encontrado")
     * )
     */
    public function show(Aluno $aluno): AlunoResource
    {
        return new AlunoResource($aluno);
    }

    /**
     * @OA\Put(
     *     path="/alunos/{idAluno}",
     *     tags={"Alunos"},
     *     summary="Atualiza os dados de um aluno",
     *     @OA\Parameter(
     *         name="idAluno",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nomeAluno", type="string", example="Maria Silva Souza"),
     *             @OA\Property(property="cpfAluno", type="integer", example=12345678900),
     *             @OA\Property(property="emailAluno", type="string", example="maria.souza@email.com"),
     *             @OA\Property(property="telefoneAluno", type="integer", example=31998765432)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Aluno atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Aluno")
     *     ),
     *     @OA\Response(response=404, description="Aluno não encontrado"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function update(UpdateAlunoRequest $request, Aluno $aluno): AlunoResource
    {
        $aluno->update($request->validated());

        return new AlunoResource($aluno);
    }

    /**
     * @OA\Delete(
     *     path="/alunos/{idAluno}",
     *     tags={"Alunos"},
     *     summary="Remove um aluno",
     *     @OA\Parameter(
     *         name="idAluno",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Aluno removido com sucesso"),
     *     @OA\Response(response=404, description="Aluno não encontrado")
     * )
     */
    public function destroy(Aluno $aluno): JsonResponse
    {
        $aluno->delete();

        return response()->json(null, 204);
    }
}

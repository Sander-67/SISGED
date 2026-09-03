<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Models\Aluno;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/auth/administrador/login",
     *     tags={"Autenticação"},
     *     summary="Login de administrador (acesso total)",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"emailAdministrador","senhaAdministrador"},
     *             @OA\Property(property="emailAdministrador", type="string", example="admin@sisged.com"),
     *             @OA\Property(property="senhaAdministrador", type="string", example="senha123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Login realizado com sucesso"),
     *     @OA\Response(response=401, description="Credenciais inválidas")
     * )
     */
    public function loginAdministrador(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'emailAdministrador' => 'required|email',
            'senhaAdministrador' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $administrador = Administrador::where('emailAdministrador', $request->emailAdministrador)->first();

        if (! $administrador || ! Hash::check($request->senhaAdministrador, $administrador->senhaAdministrador)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $administrador->createToken('token-administrador', ['administrador'])->plainTextToken;

        return response()->json([
            'tipo' => 'administrador',
            'token' => $token,
            'administrador' => $administrador,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/auth/aluno/login",
     *     tags={"Autenticação"},
     *     summary="Login de aluno (acesso restrito, somente leitura de cursos)",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"emailAluno","senhaAluno"},
     *             @OA\Property(property="emailAluno", type="string", example="aluno@email.com"),
     *             @OA\Property(property="senhaAluno", type="string", example="senha123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Login realizado com sucesso"),
     *     @OA\Response(response=401, description="Credenciais inválidas")
     * )
     */
    public function loginAluno(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'emailAluno' => 'required|email',
            'senhaAluno' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $aluno = Aluno::where('emailAluno', $request->emailAluno)->first();

        if (! $aluno || ! Hash::check($request->senhaAluno, $aluno->senhaAluno)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $aluno->createToken('token-aluno', ['aluno'])->plainTextToken;

        return response()->json([
            'tipo' => 'aluno',
            'token' => $token,
            'aluno' => $aluno,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     tags={"Autenticação"},
     *     summary="Logout (invalida o token atual)",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Logout realizado com sucesso")
     * )
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
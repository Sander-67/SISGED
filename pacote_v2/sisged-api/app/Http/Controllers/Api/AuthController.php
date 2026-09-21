<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Models\Aluno;
use App\Models\Instrutor;
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
            'deve_trocar_senha' => (bool) $aluno->deve_trocar_senha,
            'aluno' => $aluno,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/auth/instrutor/login",
     *     tags={"Autenticação"},
     *     summary="Login de instrutor (acesso às funcionalidades do instrutor)",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"emailInstrutor","senhaInstrutor"},
     *             @OA\Property(property="emailInstrutor", type="string", example="instrutor@email.com"),
     *             @OA\Property(property="senhaInstrutor", type="string", example="senha123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Login realizado com sucesso"),
     *     @OA\Response(response=401, description="Credenciais inválidas")
     * )
     */
    public function loginInstrutor(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'emailInstrutor' => 'required|email',
            'senhaInstrutor' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $instrutor = Instrutor::where('emailInstrutor', $request->emailInstrutor)->first();

        if (! $instrutor || ! Hash::check($request->senhaInstrutor, $instrutor->senhaInstrutor)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $instrutor->createToken('token-instrutor', ['instrutor'])->plainTextToken;

        return response()->json([
            'tipo' => 'instrutor',
            'token' => $token,
            'deve_trocar_senha' => (bool) $instrutor->deve_trocar_senha,
            'instrutor' => $instrutor,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/auth/trocar-senha",
     *     tags={"Autenticação"},
     *     summary="Troca a senha do usuário autenticado (aluno, instrutor ou administrador)",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"senha_atual","nova_senha"},
     *             @OA\Property(property="senha_atual", type="string", example="Aluno@123"),
     *             @OA\Property(property="nova_senha", type="string", example="MinhaNovaSenha123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Senha alterada com sucesso"),
     *     @OA\Response(response=401, description="Senha atual incorreta")
     * )
     */
    public function trocarSenha(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'senha_atual' => 'required|string',
            'nova_senha' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $usuario = $request->user();

        // Descobre qual é o campo de senha de acordo com o tipo do
        // usuário autenticado (Aluno, Instrutor ou Administrador).
        $campoSenha = match (get_class($usuario)) {
            Aluno::class => 'senhaAluno',
            Instrutor::class => 'senhaInstrutor',
            Administrador::class => 'senhaAdministrador',
            default => null,
        };

        if (! $campoSenha) {
            return response()->json(['message' => 'Tipo de usuário não suportado'], 400);
        }

        if (! Hash::check($request->senha_atual, $usuario->{$campoSenha})) {
            return response()->json(['message' => 'Senha atual incorreta'], 401);
        }

        $usuario->{$campoSenha} = Hash::make($request->nova_senha);

        if (in_array('deve_trocar_senha', $usuario->getFillable())) {
            $usuario->deve_trocar_senha = false;
        }

        $usuario->save();

        return response()->json(['message' => 'Senha alterada com sucesso']);
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
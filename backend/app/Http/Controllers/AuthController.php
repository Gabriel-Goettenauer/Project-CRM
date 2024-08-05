<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $messages = [
            'phone.unique' => 'O telefone já está em uso.',
            'email.unique' => 'O email já está em uso.',
        ];

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'dateOfBirth' => 'required|date',
            'password' => 'required|string|min:8'
        ], $messages);

        $token = $this->authService->register($request->all());

        $currentDate = now()->toDateTimeString();
        return response()->json([
            'message' => 'Cadastro feito com sucesso',
            'token' => $token,
            'date' => $currentDate
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $result = $this->authService->login($credentials);

        if ($result === null) {
            return response()->json(['message' => 'Usuário não encontrado'], 401);
        }

        return response()->json([
            'message'       => 'Login realizado com sucesso',
            'access_token'  => $result['token'],
            'token_type'    => 'Bearer',
            'tokenable_id'  => $result['user']->id
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());
        return response()->json(['message' => 'Logout realizado com sucesso'], 200);
    }


    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)])
            : response()->json(['message' => __($status)], 400);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed',
        ]);


        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Senha atualizada com sucesso.']);
    }

    public function getUser($id)
    {
        $user = $this->authService->findById($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user);
    }
}

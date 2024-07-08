<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\login;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'dateOfBirth' => 'required|date',
            'password' => 'required|string'
        ]);

        
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255|unique:login',
            'password'  => 'required|string'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = Login::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
        'data'          => $user,
        'access_token'  => $token,
        'token_type'    => 'Bearer'
        ]);

        $currentDate = now()->toDateTimeString();
        return response()->json([
            'message' => 'Cadastro feito com sucesso',
            'date' => $currentDate
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|max:255',
            'password'  => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $credentials    =   $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return response()->json(['message' => 'User not found'], 401);
        }

        $user   = Login::where('email', $request->email)->firstOrFail();
        $token  = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'       => 'Login success',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
}

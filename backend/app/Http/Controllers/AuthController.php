<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Login;

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

        $credentials = $request;
        Auth::attempt($credentials);
        

        $user = Login::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'dateOfBirth'=>$request->dateOfBirth,
            'password'  => Hash::make($request->password)
        ]);


        $token = $user->createToken('auth_token')->plainTextToken;

        $currentDate = now()->toDateTimeString();
        return response()->json([
            'message' => 'Cadastro feito com sucesso',
            'date' => $currentDate
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');

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

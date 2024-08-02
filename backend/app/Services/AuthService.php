<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthService
{
    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }
        
        $user = User::where('email', $credentials['email'])->firstOrFail();
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
    }

    public function sendResetLink(array $data)
    {
        return Password::sendResetLink($data);
    }

    public function resetPassword(array $data)
    {
        return Password::reset(
            $data,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );
    }

    public function findById($id)
    {
        return User::find($id);
    }
}

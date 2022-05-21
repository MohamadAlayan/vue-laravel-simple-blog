<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public static function login($credentials): ?array
    {
        if (Auth::attempt($credentials)) {
            /** @var User $user */
            $user = Auth::user();
            $token = null;

            //generate the token for the user
            if ($user !== null) {
                $token = $user->createToken($user->email . now())->plainTextToken;
            }
            return [
                'user' => $user,
                'token' => $token
            ];
        }

        return null;
    }
}

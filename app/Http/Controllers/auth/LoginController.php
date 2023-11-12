<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\Login;

class LoginController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => false,
            'message' => 'Akses tidak diizinkan'
        ], 401);
    }

    public function authenticate(Login $request)
    {
        $user = new User();
        $isAuthenticate = $user->login($request->username, $request->password);

        if ($isAuthenticate) {
            $token = $isAuthenticate->createToken('authToken')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Berhasil login',
                'data' => [
                    'user' => $isAuthenticate,
                    'token' => $token
                ]
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Username atau password salah'
        ], 401);
    }
}

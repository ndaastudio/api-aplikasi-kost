<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\Register;

class RegisterController extends Controller
{
    public function createAkunPenjaga(Register $request)
    {
        $user = new User();
        $isRegistered = $user->register($request->all());

        if ($isRegistered) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil membuat akun',
                'data' => $isRegistered
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server'
        ], 400);
    }
}

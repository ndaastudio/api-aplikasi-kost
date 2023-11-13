<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\Register;
use App\Models\User;

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
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 400);
    }
}

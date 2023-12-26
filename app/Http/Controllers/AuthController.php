<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\auth\Login;
use App\Http\Requests\auth\Logout;
use App\Models\Identitas;

class AuthController extends Controller
{
    public function login(Login $request)
    {
        $isAvailableUpdate = version_compare($request->version, env('APP_VERSION'), '<');

        if ($isAvailableUpdate) {
            return response()->json([
                'status' => false,
                'message' => [
                    'update' => 'Aplikasi telah tersedia dalam versi terbaru, silahkan update aplikasi Anda!',
                ],
                'data' => [
                    'update_url' => env('APP_UPDATE_URL'),
                ],
            ]);
        }

        $user = new User();
        $identitas = new Identitas();
        $isAuthenticate = $user->loginUser($request->all());

        if ($isAuthenticate) {
            $userToken = $isAuthenticate->tokens()->where('name', $isAuthenticate->username)->first();
            $userData = $identitas->getUserByIdWithIdentitas($isAuthenticate->id);

            if (!$userToken) {
                $userToken = $isAuthenticate->createToken($isAuthenticate->username)->plainTextToken;
            } else if ($userToken && $request->konfirmasi_login == 1) {
                $isAuthenticate->tokens()->where('name', $isAuthenticate->username)->delete();
                $userToken = $isAuthenticate->createToken($isAuthenticate->username)->plainTextToken;
            } else {
                return response()->json([
                    'status' => false,
                    'message' => [
                        'confirm' => 'Akun anda sedang digunakan pada perangkat lain. Apakah anda yakin ingin login di perangkat ini?',
                    ]
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Berhasil login!',
                ],
                'data' => $userData,
                'token' => $userToken,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Kombinasi username dan password yang Anda masukkan salah!',
                ],
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function logout(LogoutRequest $request, User $user)
    {
        $isLoggedOut = $user->logout($request->id);

        if ($isLoggedOut) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Logout berhasil',
                ],
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdentitasRequest;
use App\Models\User;
use App\Models\Identitas;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function create(UserRequest $request, User $user, Identitas $identitas)
    {
        try {
            DB::beginTransaction();
            $isCreatedUser = $user->register($request->all());
            $identitas->store($isCreatedUser->id);
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Akun berhasil dibuat',
                ]
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function getAll(User $user)
    {
        $userData = $user->showAll();

        if ($userData->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $userData,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function getById(User $user, string $id)
    {
        $userData = $user->showById($id);

        if ($userData) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $userData,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function deleteById(User $user, string $id)
    {
        $isDeleted = $user->destroyById($id);

        if ($isDeleted) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data berhasil dihapus',
                ],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function editIdentitasByUserId(IdentitasRequest $request, Identitas $identitas, string $id)
    {
        $isUpdated = $identitas->updateByUserId($request->all(), $id);

        if ($isUpdated) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data berhasil diubah',
                ],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }
}

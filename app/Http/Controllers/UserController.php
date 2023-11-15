<?php

namespace App\Http\Controllers;

use App\Http\Requests\Identitas as IdentitasRequest;
use App\Models\User;
use App\Models\Identitas;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\User as UserRequest;

class UserController extends Controller
{
    public function create(UserRequest $request)
    {
        $user = new User();
        $identitas = new Identitas();

        try {
            DB::beginTransaction();
            $isCreatedUser = $user->createUser($request->all());
            $identitas->createIdentitas($isCreatedUser->id);
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Berhasil membuat akun!',
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

    public function getAll()
    {
        $identitas = new Identitas();
        $users = $identitas->getAllUserWithIdentitas();

        if ($users->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan!',
                ],
                'data' => $users,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan!',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function getById(string $id)
    {
        $identitas = new Identitas();
        $user = $identitas->getUserByIdWithIdentitas($id);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan!',
                ],
                'data' => $user,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan!',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function deleteById(string $id)
    {
        $user = new User();
        $isDeleted = $user->deleteUserById($id);

        if ($isDeleted) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Berhasil menghapus akun!',
                ],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Akun tidak ditemukan!',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function editIdentitasByUserId(IdentitasRequest $request, string $id)
    {
        $identitas = new Identitas();
        $isUpdated = $identitas->editIdentitas($request->all(), $id);

        if ($isUpdated) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Berhasil mengubah data!',
                ],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan!',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }
}

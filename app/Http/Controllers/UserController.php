<?php

namespace App\Http\Controllers;

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
        $users = $identitas->with('user')->get();

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
        $user = $identitas->with('user')->where('user_id', $id)->first();

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
}

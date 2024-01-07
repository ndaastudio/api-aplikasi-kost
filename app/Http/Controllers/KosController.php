<?php

namespace App\Http\Controllers;

use App\Http\Requests\KosRequest;
use App\Models\Kos;

class KosController extends Controller
{
    public function getAll(Kos $kos)
    {
        $kosData = $kos->showAll();

        if ($kosData->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $kosData
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

    public function getById(Kos $kos, string $id)
    {
        $kosData = $kos->showById($id);

        if ($kosData) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $kosData,
                'date_now' => date('Y-m-d')
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

    public function create(KosRequest $request, Kos $kos)
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

        $isCreatedKos = $kos->store($request->all());

        if ($isCreatedKos) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Kos berhasil ditambahkan',
                ]
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Kos gagal ditambahkan',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function deleteById(Kos $kos, string $id)
    {
        $isDeletedKos = $kos->destroyById($id);

        if ($isDeletedKos) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Kos berhasil dihapus',
                ]
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

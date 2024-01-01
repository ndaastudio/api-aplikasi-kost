<?php

namespace App\Http\Controllers;

use App\Models\Kamar;

class KamarController extends Controller
{
    public function getByKosId(Kamar $kamar, string $kosId)
    {
        $kamarData = $kamar->showByKosId($kosId);

        if ($kamarData->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $kamarData
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

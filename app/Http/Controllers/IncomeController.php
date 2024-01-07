<?php

namespace App\Http\Controllers;

use App\Models\Income;

class IncomeController extends Controller
{
    public function getAll(Income $income)
    {
        $incomeData = $income->showAll();

        if (count($incomeData) > 0) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $incomeData,
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function create(InvoiceRequest $request)
    {
        ///
    }

    public function getAll(Invoice $invoice)
    {
        $invoiceData = $invoice->showAll();

        if ($invoiceData->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $invoiceData,
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

    public function getById(Invoice $invoice, string $id)
    {
        $invoiceData = $invoice->showById($id);

        if ($invoiceData) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $invoiceData,
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

    public function getByKosId(Invoice $invoice)
    {
        $kosId = auth()->user()->kos_id;
        $invoiceData = $invoice->showByKosId($kosId);

        if ($invoiceData->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $invoiceData,
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
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function create(InvoiceRequest $request, Invoice $invoice)
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

        $isCreatedInvoice = $invoice->store($request->all());

        if ($isCreatedInvoice) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Invoice berhasil dibuat',
                ]
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Invoice gagal dibuat',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
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

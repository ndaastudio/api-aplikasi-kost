<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function create(InvoiceRequest $request)
    {
        $imgDecoded = base64_decode($request->bukti);
        $encryptedImgName = Crypt::encryptString($request->order_id, env('APP_KEY'));
        $imgName = substr($encryptedImgName, 0, 50) . '.jpg';
        $disk = Storage::build([
            'driver' => 'local',
            'root' => 'storage/bukti-pembayaran',
        ]);

        $disk->put($imgName, $imgDecoded);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengunggah bukti pembayaran',
            'data' => [
                'bukti' => $imgName,
            ],
        ]);
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
                'data' => $invoiceData
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
                'data' => $invoiceData
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

    public function getByKosId(Invoice $invoice, string $id)
    {
        $invoiceData = $invoice->showByKosId($id);

        if ($invoiceData->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $invoiceData
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

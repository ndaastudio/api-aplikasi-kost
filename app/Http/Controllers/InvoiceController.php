<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function create(InvoiceRequest $request)
    {
        $imgDecoded = base64_decode($request->bukti);
        $imgName = Hash::make($request->order_id) . '.jpg';
        Storage::disk('public')->put($imgName, $imgDecoded);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengunggah bukti pembayaran',
            'data' => [
                'bukti' => $imgName,
            ],
        ]);
    }
}

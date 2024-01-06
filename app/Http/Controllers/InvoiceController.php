<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
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
}

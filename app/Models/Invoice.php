<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    const BUKTI_PEMBAYARAN_PATH = 'Bukti-Pembayaran';

    use HasFactory, SoftDeletes;

    protected $table = 'invoice';

    protected $fillable = [
        'order_id',
        'nomor_invoice',
        'tanggal',
        'jumlah',
        'status',
        'bukti',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function showAll(): object
    {
        return $this->with(['order.kamar.kos', 'order.customer'])->get();
    }

    public function showById($id): object|null
    {
        return $this->with(['order.kamar.kos', 'order.customer'])->where('id', $id)->first();
    }

    public function showByKosId($kosId): object
    {
        return $this->with(['order.kamar.kos', 'order.customer'])->whereHas('order.kamar.kos', function ($query) use ($kosId) {
            $query->where('id', $kosId);
        })->get();
    }

    public function store($data): bool|object
    {
        try {
            DB::beginTransaction();
            $kostName = Order::with('kamar.kos')->where('id', $data['order_id'])->first()->kamar->kos->nama_kos;
            $tmpKostCodeName = preg_replace('/\B\w/', '', $kostName);
            $resultKostCodeName = preg_replace('/\s+/', '', ucwords($tmpKostCodeName));
            $data['nomor_invoice'] = 'INV/' . date('Ymd') . '/' . $resultKostCodeName . random_int(10, 99) . '/' . random_int(100, 999);

            $imgDecoded = base64_decode($data['bukti']['base64String']);
            $encryptedImgName = Crypt::encryptString($data['order_id'], env('APP_KEY'));
            $resultImgName = substr($encryptedImgName, 0, 50) . '.' . $data['bukti']['format'];
            $disk = Storage::build([
                'driver' => 'local',
                'root' => $this::BUKTI_PEMBAYARAN_PATH,
                'visibility' => 'public'
            ]);
            $disk->put($resultImgName, $imgDecoded);
            $filePath = $this::BUKTI_PEMBAYARAN_PATH . '/' . $resultImgName;
            $fileUrl = asset($filePath);
            $data['bukti'] = $fileUrl;

            $this->create($data);
            DB::commit();
            return true;
        } catch (\Throwable) {
            DB::rollback();
            return false;
        }
    }
}

<?php

namespace App\Models;

use App\Models\Kamar;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    const KTP_PATH = 'KTP';

    use HasFactory, SoftDeletes;

    protected $table = 'order';

    protected $fillable = [
        'kamar_id',
        'nomor_order',
        'tanggal_masuk',
        'durasi',
        'keterangan',
        'status',
    ];

    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class);
    }

    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function showAll(): object
    {
        return $this->with(['kamar.kos', 'customer', 'invoice'])->get();
    }

    public function showById($id): object|null
    {
        return $this->with(['kamar.kos', 'customer', 'invoice'])->where('id', $id)->first();
    }

    public function showByKosId($kosId): object
    {
        return $this->with(['kamar.kos', 'customer', 'invoice'])->whereHas('kamar.kos', function ($query) use ($kosId) {
            $query->where('id', $kosId);
        })->get();
    }

    public function store($data): bool|object
    {
        try {
            DB::beginTransaction();
            $customerModel = new Customer();
            $kamarModel = new Kamar();

            $kostName = Kamar::with('kos')->where('id', $data['kamar_id'])->first()->kos->nama_kos;
            $tmpKostCodeName = preg_replace('/\B\w/', '', $kostName);
            $resultKostCodeName = preg_replace('/\s+/', '', ucwords($tmpKostCodeName));
            $data['nomor_order'] = 'ORD/' . date('Ymd') . '/' . $resultKostCodeName . random_int(10, 99) . '/' . random_int(100, 999);

            $customerData = $data['penghuni'];
            $createdOrder = $this->create($data);

            foreach ($customerData as $customer) {
                $imgDecoded = base64_decode($customer['ktp']['base64String']);
                $encryptedImgName = Crypt::encryptString($createdOrder->id, env('APP_KEY'));
                $resultImgName = substr($encryptedImgName, 0, 50) . '.' . $customer['ktp']['format'];
                $disk = Storage::build([
                    'driver' => 'local',
                    'root' => $this::KTP_PATH,
                    'visibility' => 'public'
                ]);
                $disk->put($resultImgName, $imgDecoded);
                $filePath = $this::KTP_PATH . '/' . $resultImgName;
                $fileUrl = asset($filePath);

                $customer['order_id'] = $createdOrder->id;
                $customer['ktp'] = $fileUrl;
                $customerModel->store($customer);
            }

            $kamarModel->updateById($data['kamar_id'], ['status' => 1]);
            DB::commit();
            return true;
        } catch (\Throwable) {
            DB::rollback();
            return false;
        }
    }

    public function close($data): bool
    {
        try {
            DB::beginTransaction();
            $kamarModel = new Kamar();
            $order = $this->where('id', $data['order_id'])->first();
            $kamar = $kamarModel->where('id', $data['kamar_id'])->first();

            $order->update(['status' => 0]);
            $kamar->update(['status' => 0]);
            DB::commit();
            return true;
        } catch (\Throwable) {
            DB::rollback();
            return false;
        }
    }
}

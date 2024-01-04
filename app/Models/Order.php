<?php

namespace App\Models;

use App\Models\Kamar;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
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
}

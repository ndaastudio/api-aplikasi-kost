<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order';

    protected $fillable = [
        'kamar_id',
        'tanggal_masuk',
        'durasi',
        'keterangan',
    ];

    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}

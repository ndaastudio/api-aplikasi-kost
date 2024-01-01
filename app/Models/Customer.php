<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'order_id',
        'nama_customer',
        'telepon',
        'whatsapp',
        'pekerjaan',
        'ktp',
    ];
}

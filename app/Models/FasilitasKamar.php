<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FasilitasKamar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fasilitas_kamar';

    protected $fillable = [
        'kamar_id',
        'fasilitas_id',
        'jumlah',
        'keterangan',
    ];
}

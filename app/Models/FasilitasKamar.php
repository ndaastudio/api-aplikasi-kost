<?php

namespace App\Models;

use App\Models\Fasilitas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function fasilitas(): BelongsTo
    {
        return $this->belongsTo(Fasilitas::class);
    }
}

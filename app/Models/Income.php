<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $table = 'income';
    protected $fillable = [
        'kos_id',
        'bulan',
        'tahun',
        'total'
    ];
}

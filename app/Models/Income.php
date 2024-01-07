<?php

namespace App\Models;

use App\Models\Kos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Income extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'income';

    protected $fillable = [
        'kos_id',
        'bulan',
        'tahun',
        'total',
    ];

    public function kos(): BelongsTo
    {
        return $this->belongsTo(Kos::class);
    }

    public function showAll()
    {
        $sumIncomePerKos = $this->selectRaw('kos_id, sum(total) as total')
            ->groupBy('kos_id')
            ->with('kos')
            ->get();

        $resultIncomePerKos = $sumIncomePerKos->map(function ($item) {
            return [
                'total' => $item['total'],
                'kos' => $item['kos'],
            ];
        });

        $sumIncomePerMonth = $this->selectRaw('bulan, tahun, sum(total) as total')
            ->groupBy('bulan')
            ->groupBy('tahun')
            ->where('tahun', date('Y'))
            ->get();

        $resultIncomePerMonth = $sumIncomePerMonth->map(function ($item) {
            return [
                'bulan' => $item['bulan'],
                'tahun' => $item['tahun'],
                'total' => $item['total'],
            ];
        });

        $resultData = [
            'income_per_kos' => $resultIncomePerKos,
            'income_per_bulan' => $resultIncomePerMonth,
        ];

        return $resultData;
    }
}

<?php

namespace App\Models;

use App\Models\Kos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;

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

    public function showAll(): array
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
        
        $orderedResultIncomePerKos = array_values(Arr::sort($resultIncomePerKos, function (array $value) {
            return $value['kos']['nama_kos'];
        }));

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
            'income_per_kos' => $orderedResultIncomePerKos,
            'income_per_bulan' => $resultIncomePerMonth,
        ];

        return $resultData;
    }

    public function showByKosId($id): array
    {
        $sumIncomePerKosByKosId = $this->selectRaw('kos_id, sum(total) as total')
            ->groupBy('kos_id')
            ->where('kos_id', $id)
            ->with('kos')
            ->get();

        $resultIncomePerKosByKosId = $sumIncomePerKosByKosId->map(function ($item) {
            return [
                'total' => $item['total'],
                'kos' => $item['kos'],
            ];
        });

        $sumIncomePerMonthByKosId = $this->selectRaw('bulan, tahun, sum(total) as total')
            ->groupBy('bulan')
            ->groupBy('tahun')
            ->where('tahun', date('Y'))
            ->where('kos_id', $id)
            ->get();

        $resultIncomePerMonthByKosId = $sumIncomePerMonthByKosId->map(function ($item) {
            return [
                'bulan' => $item['bulan'],
                'tahun' => $item['tahun'],
                'total' => $item['total'],
            ];
        });

        $resultData = [
            'data_kos' => $resultIncomePerKosByKosId,
            'income_per_bulan' => $resultIncomePerMonthByKosId,
        ];

        return $resultData;
    }

    public function showByMonthYear($month, $year): array
    {
        $sumIncomePerMonthYear = $this->selectRaw('bulan, tahun, sum(total) as total')
            ->groupBy('bulan')
            ->groupBy('tahun')
            ->where('bulan', $month)
            ->where('tahun', $year)
            ->get();

        $resultIncomePerMonthYear = $sumIncomePerMonthYear->map(function ($item) {
            return [
                'bulan' => $item['bulan'],
                'tahun' => $item['tahun'],
                'total' => $item['total'],
            ];
        });

        $sumIncomePerKosMonthYear = $this->selectRaw('kos_id, sum(total) as total')
            ->groupBy('kos_id')
            ->where('bulan', $month)
            ->where('tahun', $year)
            ->with('kos')
            ->get();

        $resultIncomePerKosMonthYear = $sumIncomePerKosMonthYear->map(function ($item) {
            return [
                'total' => $item['total'],
                'kos' => $item['kos'],
            ];
        });
        
        $orderedresultIncomePerKosMonthYear = array_values(Arr::sort($resultIncomePerKosMonthYear, function (array $value) {
            return $value['kos']['nama_kos'];
        }));

        $resultData = [
            'income_per_bulan_tahun' => $resultIncomePerMonthYear,
            'income_kos_per_bulan_tahun' => $orderedresultIncomePerKosMonthYear,
        ];

        return $resultData;
    }
}

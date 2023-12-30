<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Identitas extends Model
{
    use HasFactory;

    protected $table = 'identitas';

    protected $fillable = [
        'user_id',
        'nama',
        'telepon',
        'whatsapp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function store($userId): object
    {
        return $this->create([
            'user_id' => $userId,
        ]);
    }

    public function showByUserId($userId): object
    {
        return $this->with('user')->where('user_id', $userId)->first();
    }

    public function showAllUser(): object
    {
        return $this->with('user')->get();
    }

    public function updateByUserId($data, $userId): bool
    {
        return $this->where('user_id', $userId)->update($data);
    }
}

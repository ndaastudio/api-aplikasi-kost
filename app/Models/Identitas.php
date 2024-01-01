<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function store($userId): object
    {
        return $this->create([
            'user_id' => $userId,
        ]);
    }

    public function updateByUserId($data, $userId): bool
    {
        return $this->where('user_id', $userId)->update($data);
    }
}

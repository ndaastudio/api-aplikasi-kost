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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createIdentitas($userId)
    {
        return $this->create([
            'user_id' => $userId,
        ]);
    }
}

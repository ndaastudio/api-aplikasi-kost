<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kos_id',
        'username',
        'password',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function login($data)
    {
        $user = $this->where('username', $data['username'])->first();

        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                return $user;
            }
        }

        return false;
    }

    public function register($data)
    {
        return $this->create([
            'kos_id' => $data['kos_id'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'level' => $data['level'],
        ]);
    }

    public function logout($data)
    {
        $user = $this->where('username', $data['username'])->first();

        if ($user) {
            $user->tokens()->where('name', $user->username)->delete();
            return true;
        }

        return false;
    }
}

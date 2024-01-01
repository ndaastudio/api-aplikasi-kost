<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Kos;
use App\Models\Identitas;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function kos(): HasMany
    {
        return $this->hasMany(Kos::class, 'kos_id');
    }

    public function identitas(): HasOne
    {
        return $this->hasOne(Identitas::class, 'user_id');
    }

    public function login($data): object|bool
    {
        $user = $this->with('identitas')->where('username', $data['username'])->first();

        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                return $user;
            }
        }

        return false;
    }

    public function logout($id): bool
    {
        $user = $this->where('id', $id)->first();

        return $user->tokens()->where('name', $user->username)->delete();
    }

    public function register($data): object
    {
        return $this->create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'level' => $data['level'],
        ]);
    }

    public function destroyById($id): bool
    {
        $user = $this->where('id', $id)->first();

        if (!$user) {
            return false;
        }

        $user->tokens()->where('name', $user->username)->delete();

        return $user->delete();
    }

    public function showAll(): object
    {
        return $this->with('identitas')->get();
    }

    public function showById($id): object
    {
        return $this->with('identitas')->where('id', $id)->first();
    }
}

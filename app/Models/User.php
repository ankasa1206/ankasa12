<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel akan meng-hash password secara otomatis
    ];

    /**
     * Relasi: Guru sebagai wali kelas (1 guru = 1 kelas)
     */
    public function kelasWali(): HasOne
    {
        return $this->hasOne(Kelas::class, 'user_id');
    }

    /**
     * Relasi: Guru mengajar banyak mapel
     */
    public function mapels(): BelongsToMany
    {
        return $this->belongsToMany(
            Mapel::class,
            'guru_mapel',
            'user_id',
            'mapel_id'
        );
    }
}
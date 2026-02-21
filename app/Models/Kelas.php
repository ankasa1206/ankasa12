<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'kapasitas',
        'user_id',
    ];

    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔥 TAMBAHKAN INI
    public function santris()
    {
        return $this->hasMany(\App\Models\Santri::class, 'kelas_id');
    }
}
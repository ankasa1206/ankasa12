<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    // Tambahkan baris ini
    protected $fillable = [
        'user_id', // Sesuaikan dengan nama kolom di database Anda
        'kelas_id',
        'nama_santri',
        'foto_santri',
        'tanggal_lahir',
        'nis',
        'status_verifikasi',
        'jenis_kelamin',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke model Kelas (Opsional, agar bisa panggil nama kelas juga)
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}


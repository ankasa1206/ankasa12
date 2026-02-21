<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mapel extends Model
{
    protected $table = 'mapels'; // pastikan nama tabel benar

    protected $fillable = [
        'nama_mapel', // sesuaikan dengan kolom di database
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'guru_mapel', 'mapel_id', 'user_id');
    }
}
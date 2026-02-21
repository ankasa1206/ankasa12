<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  
public function run(): void
{
    $data = [
        ['nama_mapel' => 'Bahasa Arab', 'kode_mapel' => 'BARB'],
        ['nama_mapel' => 'Tahfidz Al-Qur\'an', 'kode_mapel' => 'THFZ'],
        ['nama_mapel' => 'Fiqih', 'kode_mapel' => 'FQH'],
        ['nama_mapel' => 'Nahwu Shorof', 'kode_mapel' => 'NWS'],
        ['nama_mapel' => 'Teknologi Informasi', 'kode_mapel' => 'IT'],
    ];

    foreach ($data as $item) {
        \App\Models\Mapel::create($item);
    }
}
}

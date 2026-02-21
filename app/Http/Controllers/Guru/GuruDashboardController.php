<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class GuruDashboardController extends Controller
{
public function index()
{
    $user = Auth::user();

    // Mengambil data kelas di mana guru ini adalah walinya
    $kelasSaya = $user->kelasYangDiampu; 

    // Jika guru punya kelas, hitung santri hanya di kelas itu saja
    $totalSantriDiKelas = $kelasSaya ? $kelasSaya->santris()->count() : 0;
    
    $totalSantriPesantren = Santri::count();
    $mapels = $user->mapels ?? [];

    return view('guru.dashboard', compact(
        'user', 
        'kelasSaya', 
        'totalSantriDiKelas', 
        'totalSantriPesantren', 
        'mapels'
    ));
}
}
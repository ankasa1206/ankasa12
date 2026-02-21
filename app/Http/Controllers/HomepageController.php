<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        // Mengambil statistik untuk ditampilkan di landing page
        $jumlahWali = User::where('role', 'wali')->count();
        $jumlahSantri = Santri::count(); 
        $jumlahKelas = Kelas::count();

        // Anda juga bisa menambahkan data santri terbaru jika ingin menampilkan foto/nama mereka
        $santriTerbaru = Santri::latest()->take(4)->get();

        return view('welcome', compact(
            'jumlahWali', 
            'jumlahSantri', 
            'jumlahKelas',
            'santriTerbaru'
        ));
    }
}
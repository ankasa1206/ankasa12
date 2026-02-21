<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahWali = User::where('role', 'wali')->count();
        $jumlahSantri = Santri::count(); 
        $jumlahKelas = Kelas::count();

        return view('admin.dashboard', compact('jumlahWali', 'jumlahSantri', 'jumlahKelas'));
    }
}

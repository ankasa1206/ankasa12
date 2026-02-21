<?php

namespace App\Http\Controllers\Wali;

use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PendaftaranSantriController extends Controller
{
    public function index()
    {
        $anakSaya = Santri::where('user_id', Auth::id())->get();
        return view('wali_santri.daftarSantri', compact('anakSaya'));
    }
    public function create()
    {
        $listKelas = Kelas::all(); 
        return view('wali_santri.daftar', compact('listKelas'));
    }

    // menyimpan data
    public function store(Request $request)
    {
        // 1. Validasi harus menyertakan semua field yang dibutuhkan
        $request->validate([
            'nama_santri'   => 'required|string|max:225',
            'nis'           => 'required|unique:santris,nis',
            'kelas_id'      => 'required|exists:kelas,id', // Pastikan ID kelas ada di tabel kelas
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P', // Tambahkan validasi untuk jenis kelamin
            'foto_santri'   => 'nullable|image|mimes:jpg,png|max:2048'
        ]);

        // 2. Proses upload foto
        // $pathFoto = null;
        // if ($request->hasFile('foto_santri')) {
        //     $pathFoto = $request->file('foto_santri')->store('foto_santri', 'public');
        // }
        if ($request->hasFile('foto_santri')) {
    $foto = $request->file('foto_santri')->store('santri', 'public');
} else {
    return back()->withErrors(['foto_santri' => 'Foto santri wajib diisi']);
}

        // 3. Simpan ke Database
        // Gunakan nilai dari $request secara langsung atau masukkan ke array
        Santri::create([
            'user_id'           => Auth::id(), // Pastikan di Model Santri sudah ada di $fillable
            'kelas_id'          => $request->kelas_id,
            'nama_santri'       => $request->nama_santri,
            'nis'               => $request->nis,
            'tanggal_lahir'     => $request->tanggal_lahir, // Perhatikan: di validasi namanya 'tanggal_lahir'
            'jenis_kelamin'     => $request->jenis_kelamin,
            'foto_santri'       => $foto,
            'status_verifikasi' => 'pending', 
        ]);

        return redirect()->route('wali.dashboard')->with('success', 'Pendaftaran berhasil, menunggu verifikasi admin.');
    }
}
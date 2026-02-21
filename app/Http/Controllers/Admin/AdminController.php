<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $dataKelas = Kelas::all();
        $Santri = Santri::with('user', 'kelas')
                        ->where('status_verifikasi', 'pending')
                        ->latest()
                        ->paginate(5);

        return view('admin.pendaftaran', compact('Santri', 'dataKelas'));
    }

    public function daftarSantri(Request $request)
    {
        $search = $request->get('search');
        $Santri = Santri::with('user', 'kelas')
            ->where('status_verifikasi', 'aktif')
            ->when($search, function($query) use ($search) {
                $query->where('nama_santri', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        if ($request->ajax()) {
            return view('admin.partials._santri_table', compact('Santri'))->render();
        }

        $dataKelas = Kelas::all();
        return view('admin.daftarSantri', compact('Santri', 'dataKelas'));
    }

    public function update(Request $request, $id) // Menggunakan $id agar lebih aman
    {
        $santri = Santri::findOrFail($id);

        $request->validate([
            'kelas_id' => 'required',
            'nama_santri' => 'required|string|max:225',
            'nis' => 'required|unique:santris,nis,' . $santri->id,
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'foto_santri' => 'nullable|image|mimes:jpg,png|max:2048'
        ]);

        $pathFoto = $santri->foto_santri;
        if ($request->hasFile('foto_santri')) {
            // Hapus foto lama jika ada foto baru
            if ($santri->foto_santri) {
                Storage::disk('public')->delete($santri->foto_santri);
            }
            $pathFoto = $request->file('foto_santri')->store('foto_santri', 'public');
        }

        $santri->update([
            'kelas_id' => $request->kelas_id,
            'foto_santri' => $pathFoto,
            'nama_santri' => $request->nama_santri,
            'nis' => $request->nis,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        
        // Hapus file foto dari storage sebelum hapus data
        if ($santri->foto_santri) {
            Storage::disk('public')->delete($santri->foto_santri);
        }

        $santri->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:aktif,ditolak']);
        $santri = Santri::findOrFail($id);

        $santri->update(['status_verifikasi' => $request->status]);

        $pesan = $request->status == 'aktif' ? 'disetujui' : 'ditolak';
        return back()->with('success', "Pendaftaran {$santri->nama_santri} berhasil {$pesan}.");
    }
    public function show($id)
    {
        $santri = Santri::with('user', 'kelas')->findOrFail($id);
        return view('admin.detailSantri', compact('santri'));
    }
}
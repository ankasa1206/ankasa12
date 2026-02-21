<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index()
    {
        return view('admin.daftarKelas', [
            'kelas'     => Kelas::with('waliKelas')->latest()->get(),
            'listGuru'  => User::where('role', 'guru')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
            'kapasitas'  => 'required|integer|min:1',
            'user_id'    => [
                'nullable',
                'exists:users,id',
                Rule::unique('kelas', 'user_id'),
            ],
        ], [
            'nama_kelas.unique' => 'Nama kelas sudah digunakan.',
            'user_id.unique'    => 'Guru ini sudah menjadi wali kelas lain.',
        ]);

        DB::transaction(function () use ($validated) {
            Kelas::create($validated);
        });

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function update(Request $request, Kelas $kelas)
    {
        
        $validated = $request->validate([
            'nama_kelas' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kelas', 'nama_kelas')->ignore($kelas->id),
            ],
            'kapasitas'  => 'required|integer|min:1',
            'user_id'    => [
                'nullable',
                'exists:users,id',
                Rule::unique('kelas', 'user_id')->ignore($kelas->id),
            ],
        ], [
            'nama_kelas.unique' => 'Nama kelas sudah digunakan.',
            'user_id.unique'    => 'Guru ini sudah menjadi wali kelas lain.',
        ]);

        DB::transaction(function () use ($kelas, $validated) {
            $kelas->update($validated);
        });

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

  public function destroy(Kelas $kelas)
{
    try {

        if ($kelas->santris()->exists()) {
            return back()->with('error', 'Kelas tidak bisa dihapus karena masih berisi santri.');
        }

        $kelas->delete();

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil dihapus.');

    } catch (\Exception $e) {

        return back()->with('error', 'Gagal menghapus kelas. Masih terhubung dengan data lain.');
    }
}
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Menampilkan daftar guru
     */
    public function index()
    {
        $gurus = User::where('role', 'guru')
            ->with(['kelasWali', 'mapels'])
            ->latest()
            ->get();

        $mapels = Mapel::all();
        $listKelas = Kelas::whereNull('user_id')->get();

        return view('admin.daftarGuru', compact('gurus', 'mapels', 'listKelas'));
    }

    /**
     * Simpan Guru
     */
    public function store(Request $request)
{
    $request->validate([
        'name'         => 'required|string|max:255',
        'email'        => 'required|email|unique:users,email',
        'password'     => 'required|min:8',
        'kelas_id'     => 'nullable|exists:kelas,id',
        'mapel_ids'    => 'nullable|array',
        'mapel_ids.*'  => 'exists:mapels,id',
    ]);

    DB::beginTransaction();

    try {

        // 1️⃣ Buat user dulu
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'guru',
        ]);

        // 2️⃣ Set wali kelas (jika ada)
        if ($request->kelas_id) {

            $kelas = Kelas::where('id', $request->kelas_id)
                          ->whereNull('user_id')
                          ->first();

            if (!$kelas) {
                throw new \Exception('Kelas sudah memiliki wali.');
            }

            $kelas->update([
                'user_id' => $user->id
            ]);
        }

        // 3️⃣ Sync mapel
        if ($request->mapel_ids) {
            $user->mapels()->sync($request->mapel_ids);
        }

        DB::commit();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Guru berhasil ditambahkan.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()
            ->with('error', $e->getMessage())
            ->withInput();
    }
}
    /**
     * Update Guru
     */
    public function update(Request $request, User $guru)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $guru->id,
            'password'     => 'nullable|min:8',
            'kelas_id'     => 'nullable|exists:kelas,id',
            'mapel_ids'    => 'nullable|array',
            'mapel_ids.*'  => 'exists:mapels,id',
        ]);

        try {

            DB::beginTransaction();

            // Update data dasar
            $guru->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $guru->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            // Reset wali lama
            Kelas::where('user_id', $guru->id)
                ->update(['user_id' => null]);

            // Set wali baru
            if ($request->filled('kelas_id')) {
                $kelas = Kelas::find($request->kelas_id);

                if ($kelas->user_id && $kelas->user_id != $guru->id) {
                    throw new \Exception('Kelas sudah memiliki wali.');
                }

                $kelas->update([
                    'user_id' => $guru->id
                ]);
            }

            // Sync mapel
            $guru->mapels()->sync($request->mapel_ids ?? []);

            DB::commit();

            return redirect()
                ->route('admin.guru.index')
                ->with('success', 'Data guru berhasil diperbarui.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Hapus Guru
     */
    public function destroy(User $guru)
    {
        try {

            DB::beginTransaction();

            Kelas::where('user_id', $guru->id)
                ->update(['user_id' => null]);

            $guru->mapels()->detach();

            $guru->delete();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Data guru berhasil dihapus.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus data.');
        }
    }

    /**
     * Detail Guru
     */
    public function show(User $guru)
    {
        $guru->load(['kelasWali', 'mapels']);

        return view('admin.detailGuru', compact('guru'));
    }
}
<x-app-layout>
    <x-slot name="header">
    <x-teks-url :items="[
        'Daftar Santri' => route('admin.santri.index'),
        'Detail Santri ' . $santri->nama_santri => route('admin.santri.show', $santri->id),        
    ]" />
   
    </x-slot>
        <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.santri.index') }}" class="flex items-center text-green-700 hover:text-green-900 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                <span class="font-medium">Kembali ke Daftar Santri</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-800 px-8 py-6 text-white">
                <div class="flex items-center gap-6">
                <div class="h-24 w-24 bg-green-700 rounded-full flex items-center justify-center border-4 border-green-300 shadow-lg overflow-hidden">
                    @if($santri->foto_santri)
                        <img src="{{ asset('storage/' . $santri->foto_santri) }}" 
                            alt="Foto {{ $santri->nama_santri }}" 
                            class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-user text-4xl text-green-300"></i>
                    @endif
                </div>
                    <div>
                        <h1 class="text-2xl font-bold">{{ $santri->nama_santri }}</h1>
                        <p class="text-green-200 uppercase tracking-widest text-xs font-semibold mt-1">
                            NIS: {{ $santri->nis }}
                        </p>
                    </div>
                    <div class="ml-auto">
                        <span class="px-4 py-1.5 bg-green-500/20 border border-green-400 rounded-full text-xs font-bold uppercase">
                            {{ $santri->status_verifikasi }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 flex items-center">
                            <i class="fas fa-graduation-cap mr-2 text-green-700"></i> Informasi Santri
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs text-gray-400 uppercase font-bold tracking-wider">Nama Lengkap</label>
                                <p class="text-gray-700 font-medium">{{ $santri->nama_santri }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-400 uppercase font-bold tracking-wider">Kelas</label>
                                <p class="text-gray-700 font-medium">{{ $santri->kelas->nama_kelas ?? 'Belum Ditentukan' }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-400 uppercase font-bold tracking-wider">Nomor Induk Santri (NIS)</label>
                                <p class="text-gray-700 font-medium">{{ $santri->nis }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 flex items-center">
                            <i class="fas fa-user-shield mr-2 text-green-700"></i> Informasi Wali
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs text-gray-400 uppercase font-bold tracking-wider">Nama Wali</label>
                                <p class="text-gray-700 font-medium">{{ $santri->user->name }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-400 uppercase font-bold tracking-wider">Alamat Email</label>
                                <p class="text-gray-700 font-medium">{{ $santri->user->email }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-400 uppercase font-bold tracking-wider">Peran Akun</label>
                                <p class="text-gray-700 font-medium uppercase text-sm tracking-tight">{{ $santri->user->role }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-10 pt-6 border-t flex gap-3">
                    <a href="{{ route('admin.santri.edit', $santri->id) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2.5 rounded-lg font-semibold transition">
                        <i class="fas fa-edit mr-1"></i> Edit Data
                    </a>
                    <form action="{{ route('admin.santri.destroy', $santri->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-100 hover:bg-red-200 text-red-600 py-2.5 rounded-lg font-semibold transition">
                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
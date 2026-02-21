<x-app-layout>
    <x-slot name="header">
        <x-teks-url :items="[
            'Daftar Santri' => route('admin.santri.index'),
        ]" />
    </x-slot>
    
    <x-alert/>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-green-50 to-white">
            <div class="flex items-center gap-3">
                <i class="fas fa-list text-green-600 text-lg"></i>
                <h3 class="text-lg font-bold text-gray-800">Daftar Santri</h3>
            </div>
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>

        <div class="flex flex-col md:flex-row justify-end items-center py-4 gap-4">
            <div class="w-full md:w-1/2 px-2 flex items-center gap-2 ">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                    <input type="text" 
                        id="searchInput"
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau NIS santri..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-sm">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto w-full">
        <div id="tableContainer">
            @include('admin.partials._santri_table')
        </div>
        </div>

        <div class="px-4 py-4 bg-gray-50 border-t border-gray-200">
            @if (isset($Santri) && $Santri->hasPages())
                <div class="mt-4">
                    {{ $Santri->links() }}
                </div>
            @else
                <p class="text-xs text-gray-500 italic text-center">Menampilkan semua data (Halaman tunggal)</p>
            @endif
        </div>
    </div> 

    @foreach ($Santri as $s)
        <x-modal name="modal-edit-{{ $s->id }}" focusable>
            <form method="post" action="{{ route('admin.santri.update', $s->id) }}" class="p-6" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <input type="hidden" name="user_id" value="{{ $s->user_id }}">
                
                <h2 class="text-lg font-bold text-green-800 border-b pb-3">
                    <i class="fas fa-user-edit mr-2"></i>Edit Data Santri
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_santri" value="{{ old('nama_santri', $s->nama_santri) }}" required 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIS</label>
                        <input type="text" name="nis" value="{{ old('nis', $s->nis) }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $s->tanggal_lahir) }}" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            <option value="L" {{ $s->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $s->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kelas</label>
                        <select name="kelas_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            {{-- Pastikan $dataKelas dikirim dari Controller --}}
                            @foreach($dataKelas as $kelas)
                                <option value="{{ $kelas->id }}" {{ $s->kelas_id == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto Baru (Opsional)</label>
                        <input type="file" name="foto_santri" class="mt-1 block w-full text-sm text-gray-500">
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 shadow-md transition">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </x-modal>

        <x-modal name="confirm-delete-{{ $s->id }}" focusable>
            <div class="p-5">
                <div class="flex items-center justify-center text-red-600 mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>

                <h2 class="text-lg font-bold text-gray-900 text-center">Hapus Data Santri?</h2>
                <p class="mt-2 text-sm text-gray-600 text-center">
                    Apakah Anda yakin ingin menghapus <strong>{{ $s->nama_santri }}</strong>?
                </p>

                <div class="mt-6 flex justify-center space-x-3">
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <form action="{{ route('admin.santri.destroy', $s->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 shadow-md">
                            Ya, Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </x-modal>
    @endforeach
</x-app-layout>
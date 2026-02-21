<x-app-layout>
    <x-slot name="header">
        <x-teks-url :items="[ 'Daftar Guru' => route('admin.guru.index') ]" />
    </x-slot>
    
    <x-alert/>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-emerald-50 to-white">
            <div class="flex items-center gap-3">
                <i class="fas fa-chalkboard-teacher text-emerald-600 text-lg"></i>
                <h3 class="text-lg font-bold text-gray-800">Daftar Guru & Wali Kelas</h3>
            </div>
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'modal-tambah-guru')" 
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Guru
            </button>
        </div>

        <div class="flex flex-col md:flex-row justify-end items-center py-4 gap-4 px-4">
            <div class="w-full md:w-1/2 flex items-center gap-2">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                    <input type="text" id="searchInput" placeholder="Cari nama atau email..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 text-sm font-semibold text-gray-700">Nama Guru</th>
                        <th class="p-4 text-sm font-semibold text-gray-700">Email</th>
                        <th class="p-4 text-sm font-semibold text-gray-700">Wali Kelas</th>
                        <th class="p-4 text-sm font-semibold text-gray-700">Mata Pelajaran</th>
                        <th class="p-4 text-sm font-semibold text-gray-700 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gurus as $guru)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4 text-sm text-gray-800 font-medium">{{ $guru->name }}</td>
                        <td class="p-4 text-sm text-gray-600">{{ $guru->email }}</td>
                        <td class="p-4 text-sm">
                            @if($guru->kelasWali)
                                <span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded-md text-xs font-bold">
                                    {{ $guru->kelasWali->nama_kelas }}
                                </span>
                            @else
                                <span class="text-gray-400 italic text-xs">Bukan Wali Kelas</span>
                            @endif
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            @foreach($guru->mapels as $m)
                                <span class="inline-block bg-gray-100 px-2 py-0.5 rounded text-xs mr-1">{{ $m->nama_mapel }}</span>
                            @endforeach
                        </td>
                        <td class="p-4 text-center">
    <div class="flex justify-center gap-2">

        <!-- EDIT -->
        <button 
            x-on:click="$dispatch('open-modal', 'modal-edit-guru-{{ $guru->id }}')" 
            class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-edit"></i>
        </button>

        <!-- HAPUS -->
        <button 
            x-on:click="$dispatch('open-modal', 'confirm-delete-{{ $guru->id }}')" 
            class="text-red-600 hover:text-red-800">
            <i class="fas fa-trash"></i>
        </button>

    </div>
</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500 italic">Belum ada data guru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal name="modal-tambah-guru" focusable>
        <form method="post" action="{{ route('admin.guru.store') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-bold text-emerald-800 border-b pb-3">
                <i class="fas fa-user-plus mr-2"></i>Tambah Guru & Wali Kelas
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tugaskan Sebagai Wali Kelas (Opsional)</label>
                    <select name="kelas_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">-- Tidak Menjadi Wali Kelas --</option>
                        @foreach($listKelas as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <p class="text-[10px] text-gray-500 mt-1">* Satu guru hanya bisa memegang satu kelas.</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mengajar Mata Pelajaran</label>
                    <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto p-3 border rounded-md bg-gray-50">
                        @foreach($mapels as $mapel)
                        <label class="flex items-center space-x-2 text-sm">
                            <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}" class="rounded text-emerald-600 focus:ring-emerald-500">
                            <span>{{ $mapel->nama_mapel }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg">Batal</button>
                <button type="submit" class="px-4 py-2 bg-emerald-700 text-white rounded-lg hover:bg-emerald-800 shadow-md">
                    Simpan Akun Guru
                </button>
            </div>
        </form>
    </x-modal>

    @foreach ($gurus as $guru)
    <x-modal name="confirm-delete-{{ $guru->id }}" focusable>
        <div class="p-5 text-center">
            <i class="fas fa-exclamation-triangle text-red-600 text-4xl mb-4"></i>
            <h2 class="text-lg font-bold text-gray-900">Hapus Guru {{ $guru->name }}?</h2>
            <p class="mt-2 text-sm text-gray-600">Tindakan ini permanen. Akun ini tidak akan bisa login kembali.</p>

            <div class="mt-6 flex justify-center space-x-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg">Batal</button>
                <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </x-modal>
    @endforeach
    @foreach ($gurus as $guru)
<x-modal name="modal-edit-guru-{{ $guru->id }}" focusable>
    <form method="POST" action="{{ route('admin.guru.update', $guru->id) }}" class="p-6">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-bold text-blue-800 border-b pb-3">
            <i class="fas fa-user-edit mr-2"></i>Edit Guru
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">

            <!-- Nama -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" 
                    name="name" 
                    value="{{ $guru->name }}"
                    required 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" 
                    name="email" 
                    value="{{ $guru->email }}"
                    required 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Password (Kosongkan jika tidak diubah)
                </label>
                <input type="password" 
                    name="password"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Wali Kelas -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Tugaskan Sebagai Wali Kelas
                </label>

                <select name="kelas_id" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                    <option value="">-- Tidak Menjadi Wali Kelas --</option>

                    @foreach($listKelas as $kelas)
                        <option value="{{ $kelas->id }}"
                            {{ optional($guru->kelasWali)->id == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- MAPEL -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Mengajar Mata Pelajaran
                </label>

                <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto p-3 border rounded-md bg-gray-50">

                    @foreach($mapels as $mapel)
                    <label class="flex items-center space-x-2 text-sm">

                        <input type="checkbox"
                            name="mapel_ids[]"
                            value="{{ $mapel->id }}"
                            {{ $guru->mapels->contains($mapel->id) ? 'checked' : '' }}
                            class="rounded text-blue-600 focus:ring-blue-500">

                        <span>{{ $mapel->nama_mapel }}</span>

                    </label>
                    @endforeach

                </div>
            </div>

        </div>

        <div class="mt-8 flex justify-end space-x-3">
            <button type="button" 
                x-on:click="$dispatch('close')" 
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg">
                Batal
            </button>

            <button type="submit" 
                class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 shadow-md">
                Update Guru
            </button>
        </div>

    </form>
</x-modal>
@endforeach

</x-app-layout>
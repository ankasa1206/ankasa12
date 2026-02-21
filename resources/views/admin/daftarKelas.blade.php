<x-app-layout>
    <x-slot name="header">
        <x-teks-url :items="[
            'Daftar Kelas' => route('admin.kelas.index'),
        ]" />
    </x-slot>

    <x-alert/>

    {{-- CARD TABLE --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b flex justify-between items-center bg-gradient-to-r from-green-50 to-white">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-list text-green-600"></i>
                Daftar Kelas
            </h3>

            <button
                x-on:click.prevent="$dispatch('open-modal','modal-tambah-kelas')"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Tambah Data
            </button>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Kelas</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Kapasitas</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Wali Kelas</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($kelas as $k)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                                {{ $k->nama_kelas }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $k->kapasitas }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ optional($k->waliKelas)->name ?? 'Belum ada wali' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <x-action-button :id="$k->id"/>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-10 text-gray-400 italic">
                                Belum ada data kelas yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    {{-- ================= MODAL TAMBAH KELAS ================= --}}
    <x-modal name="modal-tambah-kelas" focusable>
        <form method="POST" action="{{ route('admin.kelas.store') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-bold text-green-800 border-b pb-3">
                Tambah Data Kelas
            </h2>

            <div class="grid md:grid-cols-2 gap-4 mt-6">
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Kelas</label>
                    <input type="text" name="nama_kelas"
                        value="{{ old('nama_kelas') }}"
                        required
                        class="mt-1 w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 shadow-sm">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Kapasitas</label>
                    <input type="number" name="kapasitas"
                        value="{{ old('kapasitas') }}"
                        required
                        class="mt-1 w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 shadow-sm">
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-medium text-gray-700">Wali Kelas</label>
                    <select name="user_id"
                        class="mt-1 w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 shadow-sm">
                        <option value="">-- Pilih Guru --</option>

                        @foreach($listGuru as $guru)
                            <option value="{{ $guru->id }}">
                                {{ $guru->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button"
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition shadow-md">
                    Simpan Data
                </button>
            </div>
        </form>
    </x-modal>


    @foreach($kelas as $k)

        {{-- ================= MODAL EDIT ================= --}}
        <x-modal name="modal-edit-{{ $k->id }}" focusable>
            @if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form method="POST"
                action="{{ route('admin.kelas.update', $k->id) }}"
                class="p-6">
                @csrf
                @method('PUT')

                <h2 class="text-lg font-bold text-green-800 border-b pb-3">
                    Edit Data Kelas
                </h2>

                <div class="grid md:grid-cols-2 gap-4 mt-6">

                    <div>
                        <label class="text-sm font-medium text-gray-700">Nama Kelas</label>
                        <input type="text"
                            name="nama_kelas"
                            value="{{ old('nama_kelas', $k->nama_kelas) }}"
                            required
                            class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Kapasitas</label>
                        <input type="number"
                            name="kapasitas"
                            value="{{ old('kapasitas', $k->kapasitas) }}"
                            required
                            class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-gray-700">Wali Kelas</label>
                        <select name="user_id"
                            class="mt-1 w-full border-gray-300 rounded-md shadow-sm">

                            <option value="">-- Tanpa Wali --</option>

                            {{-- Wali Saat Ini --}}
                            @if($k->waliKelas)
                                <option value="{{ $k->waliKelas->id }}" selected>
                                    {{ $k->waliKelas->name }} (Wali Saat Ini)
                                </option>
                            @endif

                            {{-- Guru yang belum dipakai --}}
                            @foreach($listGuru as $guru)
                                @if($guru->id !== $k->user_id)
                                    <option value="{{ $guru->id }}">
                                        {{ $guru->name }}
                                    </option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition shadow-md">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </x-modal>


        {{-- ================= MODAL DELETE ================= --}}
        <x-modal name="confirm-delete-{{ $k->id }}" focusable>
            <form method="POST"
                action="{{ route('admin.kelas.destroy', $k->id) }}"
                class="p-6 text-center">
                @csrf
                @method('DELETE')

                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                </div>

                <h2 class="text-xl font-bold text-gray-900 mb-2">
                    Konfirmasi Hapus
                </h2>

                <p class="text-sm text-gray-600 mb-6">
                    Apakah Anda yakin ingin menghapus kelas
                    <span class="font-bold text-red-600">
                        {{ $k->nama_kelas }}
                    </span>?
                    Data yang sudah dihapus tidak dapat dipulihkan kembali.
                </p>

                <div class="flex justify-center gap-4">
                    <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium shadow-sm">
                        Ya, Hapus Kelas
                    </button>
                </div>
            </form>
        </x-modal>

    @endforeach

</x-app-layout>
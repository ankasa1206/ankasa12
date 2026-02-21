<x-app-layout>
    <x-slot name="header">
        <div class="py-4 flex items-center">
        <x-teks-url :items="['Santri Saya' => route('wali.santri.index')]" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                
                <div class="p-6 bg-white border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Anak yang Terdaftar</h3>
                        <p class="text-sm text-gray-500">Berikut adalah daftar santri yang telah Anda daftarkan ke sistem.</p>
                    </div>
                    <a href="{{ route('wali.santri.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 transition shadow-sm">
                        <i class="fas fa-plus mr-2"></i> Tambah Santri
                    </a>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-emerald-50">
                                <tr>
                                    <th class="px-6 py-4 rounded-l-xl">Foto</th>
                                    <th class="px-6 py-4">Nama Santri</th>
                                    <th class="px-6 py-4">NIS</th>
                                    <th class="px-6 py-4">Kelas</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 rounded-r-xl text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($anakSaya as $santri)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            @if($santri->foto_santri)
                                                <img src="{{ asset('storage/'.$santri->foto_santri) }}" class="w-12 h-12 rounded-full object-cover border-2 border-emerald-100">
                                            @else
                                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-400"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-bold text-gray-800">{{ $santri->nama_santri }}</td>
                                        <td class="px-6 py-4">{{ $santri->nis }}</td>
                                        <td class="px-6 py-4">{{ $santri->kelas->nama_kelas ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="#" class="text-emerald-600 hover:text-emerald-800 font-bold mx-2">Detail</a>
                                            <a href="#" class="text-blue-600 hover:text-blue-800 font-bold mx-2">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">
                                            Belum ada santri yang didaftarkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
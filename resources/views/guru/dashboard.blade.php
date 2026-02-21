<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Wali Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-emerald-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Assalamu'alaikum, Ustadz/ah {{ $user->name }}!</h3>
                        <p class="text-gray-600 mt-1">
                            @if($kelasSaya)
                                Anda adalah Wali Kelas dari **{{ $kelasSaya->nama_kelas }}**
                            @else
                                Anda belum ditugaskan sebagai Wali Kelas.
                            @endif
                        </p>
                    </div>
                    <div class="hidden md:block text-emerald-100">
                        <i class="fas fa-user-tie text-5xl"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-purple-100 rounded-lg text-purple-600">
                            <i class="fas fa-school text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Kelas Saya</p>
                            <h4 class="text-xl font-black text-gray-800">{{ $kelasSaya->nama_kelas ?? '-' }}</h4>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-emerald-100 rounded-lg text-emerald-600">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Santri di Kelas</p>
                            <h4 class="text-2xl font-black text-gray-800">{{ $totalSantriDiKelas ?? 0 }}</h4>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-blue-100 rounded-lg text-blue-600">
                            <i class="fas fa-globe text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Total Seluruh Santri</p>
                            <h4 class="text-2xl font-black text-gray-800">{{ $totalSantriPesantren }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            @if($kelasSaya)
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-user-graduate text-emerald-600"></i>
                        Daftar Santri Kelas {{ $kelasSaya->nama_kelas }}
                    </h3>
                    <a href="#" class="text-sm text-emerald-600 hover:underline font-semibold">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-medium">
                            <tr>
                                <th class="px-6 py-3">NIS</th>
                                <th class="px-6 py-3">Nama Santri</th>
                                <th class="px-6 py-3">Gender</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($kelasSaya->santris as $santri)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm">{{ $santri->nis }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-800">{{ $santri->nama_santri }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs {{ $santri->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                        {{ $santri->jenis_kelamin }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <button class="text-emerald-600 hover:text-emerald-900"><i class="fas fa-eye"></i> Profile</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400 italic">Belum ada data santri di kelas ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-book text-emerald-600"></i>
                        Mata Pelajaran yang Anda Ampu
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @forelse($mapels as $mapel)
                            <div class="group p-4 border rounded-xl hover:border-emerald-500 hover:shadow-md transition duration-200">
                                <div class="text-xs text-emerald-600 font-bold mb-1">{{ $mapel->kode_mapel }}</div>
                                <h4 class="font-bold text-gray-800 group-hover:text-emerald-700">{{ $mapel->nama_mapel }}</h4>
                                <div class="mt-4">
                                    <button class="w-full text-xs bg-gray-100 hover:bg-emerald-600 hover:text-white py-2 rounded-lg transition font-bold text-gray-600">Input Nilai</button>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8 text-gray-500 italic">
                                Anda tidak sedang mengampu mata pelajaran.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
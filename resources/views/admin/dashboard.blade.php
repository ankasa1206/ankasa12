<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-users-cog text-green-600 text-lg"></i>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard Admin') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @php
            $stats = [
                [
                    'label' => 'Total Wali Santri',
                    'value' => $jumlahWali,
                    'icon' => 'fa-users',
                    'color' => 'green',
                    'url' => '#',
                ],
                [
                    'label' => 'Total Santri',
                    'value' => $jumlahSantri,
                    'icon' => 'fa-graduation-cap',
                    'color' => 'blue',
                    'url' => '#',
                ],
                [
                    'label' => 'Total Kelas',
                    'value' => $jumlahKelas,
                    'icon' => 'fa-boxes',
                    'color' => 'amber',
                    'url' => '#',
                ],
                ['label' => 'Webchat', 'value' => 0, 'icon' => 'fa-cube', 'color' => 'purple', 'url' => '#'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div
                class="bg-{{ $stat['color'] }}-500 rounded-xl shadow-sm transition-transform duration-200 hover:scale-105 hover:shadow-md overflow-hidden flex">
                <div class="w-2 bg-{{ $stat['color'] }}-600"></div>

                <div class="flex-1 bg-white p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500">{{ $stat['label'] }}
                            </p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stat['value'] }}</p>
                        </div>
                        <div class="bg-{{ $stat['color'] }}-100 p-3 rounded-lg">
                            <i class="fas {{ $stat['icon'] }} text-{{ $stat['color'] }}-600 text-xl"></i>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-gray-500">
                        <a href="{{ $stat['url'] }}"
                            class="text-[11px] font-bold uppercase tracking-tighter text-{{ $stat['color'] }}-600 hover:text-{{ $stat['color'] }}-700 flex items-center justify-between group">
                            Selengkapnya
                            <i class="fas fa-arrow-right transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div
            class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-green-50 to-white">
            <div class="flex items-center gap-3">
                <i class="fas fa-list text-green-600 text-lg"></i>
                <h3 class="text-lg font-bold text-gray-800">Data Wali Santri Terbaru</h3>
            </div>
            <button
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contoh data statis, nantinya akan di-loop dari database --}}
                    <tr class="border-b border-gray-200 hover:bg-green-50 transition duration-200">
                        <td class="px-6 py-4 text-sm text-gray-800">Ahmad Fauzi</td>
                        <td class="px-6 py-4 text-sm text-gray-600">ahmad@example.com</td>
                        <td class="px-6 py-4 text-sm">
                            <span
                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                        </td>
                        <td class="px-6 py-4 text-sm flex gap-3">
                            <a href="#"
                                class="text-green-600 hover:text-green-700 font-medium transition duration-200">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="#"
                                class="text-red-600 hover:text-red-700 font-medium transition duration-200">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-green-50 transition duration-200">
                        <td class="px-6 py-4 text-sm text-gray-800">Siti Nurhaliza</td>
                        <td class="px-6 py-4 text-sm text-gray-600">siti@example.com</td>
                        <td class="px-6 py-4 text-sm">
                            <span
                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                        </td>
                        <td class="px-6 py-4 text-sm flex gap-3">
                            <a href="#"
                                class="text-green-600 hover:text-green-700 font-medium transition duration-200">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="#"
                                class="text-red-600 hover:text-red-700 font-medium transition duration-200">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Empty State Fallback -->
        <div class="px-6 py-8 text-center">
            <p class="text-gray-500 text-sm">Tidak ada data wali santri</p>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>

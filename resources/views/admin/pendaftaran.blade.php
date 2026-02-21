<x-app-layout>
    <x-slot name="header">
          <x-teks-url :items="[
    'Pendaftaran Santri' => route('admin.pendaftaran'),
]" />
    </x-slot>
        <x-alert />
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-green-50 to-white">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-list text-green-600 text-lg"></i>
                        <h3 class="text-lg font-bold text-gray-800">Daftar Santri Pending</h3>
                    </div>
                       <a href="{{ route('admin.santri.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                        Lihat Santri Disetujui →
                    </a>
                </div>

             <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-70">
                       <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Santri</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Lahir</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($Santri as $s)
                        <tr>
                            <td class="px-6 py-4">{{ $s->nama_santri }}</td>
                            <td class="px-6 py-4">{{ $s->kelas_id }}</td>
                            <td class="px-6 py-4">{{ $s->nis }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($s->tanggal_lahir)->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">
                             <x-status-badge :status="$s->status_verifikasi" />
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.santri.update-status', $s->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="aktif">
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm shadow-sm" onclick="return confirm('Apakah Yakin akan menyetujui?')">
                                        Setuju
                                        </button>
                                    </form>

                            <form action="{{ route('admin.santri.update-status', $s->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm shadow-sm" onclick="return confirm('Tolak pendaftaran ini?')">
                                    Tolak
                                </button>
                            </form>
                            </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data pendaftaran pending.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
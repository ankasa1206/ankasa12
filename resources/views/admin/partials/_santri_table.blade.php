  <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Santri</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Kelas</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">NIS</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Wali santri</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($Santri as $s)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $s->nama_santri }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $s->kelas->nama_kelas ?? $s->kelas_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $s->nis }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $s->user->name ?? 'Tidak ada wali' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $s->status_verifikasi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center gap-2">
                                    <x-action-button :id="$s->id"/>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    @if(request('search'))
                                        Data santri dengan nama atau NIS "{{ request('search') }}" tidak ditemukan.
                                    @else
                                        Belum ada santri yang disetujui/aktif.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                            <script>
                            const searchInput = document.getElementById('searchInput');
                            const tableContainer = document.getElementById('tableContainer');

                            searchInput.addEventListener('keyup', function() {
                                let query = searchInput.value;

                                // Kirim request ke server secara diam-diam
                                fetch("{{ route('admin.santri.index') }}?search=" + query, {
                                    headers: {
                                        "X-Requested-With": "XMLHttpRequest"
                                    }
                                })
                                .then(response => response.text())
                                .then(data => {
                                    // Ganti isi tabel dengan hasil dari database
                                    tableContainer.innerHTML = data;
                                });
                            });
                        </script>
                        </tbody>
                    </table>

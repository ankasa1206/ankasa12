<x-app-layout>
    <x-slot name="header">
                <x-teks-url :items="[
                    'Santri Saya' => route('wali.santri.index'),
                    'Daftar Santri' => route('wali.santri.create')]" />
    </x-slot>
    <div class="py-4">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 bg-gradient-to-r from-emerald-300 to-white border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900">Formulir Pendaftaran</h2>
                    <p class="mt-1 text-sm text-gray-500">Lengkapi data santri dengan benar sesuai dokumen asli.</p>
                </div>

                <div class="p-8">
                    <form action="{{ route('wali.santri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_santri" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap Santri <span class="text-red-500">*</span></label>
                                <input type="text" id="nama_santri" name="nama_santri" value="{{ old('nama_santri') }}" required 
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 transition @error('nama_santri') border-red-500 @enderror"
                                    placeholder="Nama sesuai ijazah/KK">
                                <x-input-error :messages="$errors->get('nama_santri')" class="mt-2" />
                            </div>

                            <div>
                                <label for="nis" class="block text-sm font-semibold text-gray-700 mb-2">NIS / NISN <span class="text-red-500">*</span></label>
                                <input type="text" id="nis" name="nis" value="{{ old('nis') }}" required 
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 transition @error('nis') border-red-500 @enderror"
                                    placeholder="Masukkan nomor induk">
                                <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="kelas_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Kelas <span class="text-red-500">*</span></label>
                                <select id="kelas_id" name="kelas_id" required 
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 transition @error('kelas_id') border-red-500 @enderror">
                                    <option value="" disabled selected>-- Pilih Kelas --</option>
                                    @foreach($listKelas as $kelas)
                                        <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('kelas_id')" class="mt-2" />
                            </div>

                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required 
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 transition @error('tanggal_lahir') border-red-500 @enderror">
                                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <select id="jenis_kelamin" name="jenis_kelamin" required
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 transition @error('jenis_kelamin') border-red-500 @enderror">
                                    <option value="" disabled selected>-- Pilih --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                            </div>

                            <div>
                                <label for="foto_santri" class="block text-sm font-semibold text-gray-700 mb-2">Foto Santri</label>
                                <input type="file" id="foto_santri" name="foto_santri" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-gray-300 rounded-xl px-4 py-2 transition focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <p class="mt-1 text-xs text-gray-400 italic">Format: JPG, PNG (Maks. 2MB)</p>
                                <x-input-error :messages="$errors->get('foto_santri')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-100">
                            <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl transition duration-200 shadow-md hover:shadow-emerald-200 flex justify-center items-center gap-2">
                                <i class="fas fa-save"></i>
                                Simpan Data Santri
                            </button>
                            <button type="reset" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition duration-200">
                                Reset Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
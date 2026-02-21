<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-green-100 rounded-lg">
                <i class="fas fa-home text-green-600 text-lg"></i>
            </div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Wali Santri') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-lg shadow-lg p-8 text-white mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                        <p class="mt-2 text-green-100">Di sini Anda dapat memantau perkembangan pendidikan putra/putri Anda di pesantren kami.</p>
                    </div>
                    <div class="text-6xl opacity-20">
                        <i class="fas fa-mosque"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                    <div class="bg-gradient-to-r from-green-50 to-green-100 px-6 py-4 border-b border-green-200">
                        <div class="flex items-center gap-3">
                            <div class="bg-green-200 p-3 rounded-lg">
                                <i class="fas fa-credit-card text-green-700 text-lg"></i>
                            </div>
                            <h4 class="font-bold text-green-800 text-lg">Status Pembayaran</h4>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <p class="text-gray-600 text-sm">Status Terakhir</p>
                            <span class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full font-semibold text-lg">
                                LUNAS
                            </span>
                        </div>
                        <p class="text-gray-500 text-xs mt-4">Update terakhir: Hari ini</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
                        <div class="flex items-center gap-3">
                            <div class="bg-blue-200 p-3 rounded-lg">
                                <i class="fas fa-quran text-blue-700 text-lg"></i>
                            </div>
                            <h4 class="font-bold text-blue-800 text-lg">Hafalan Terakhir</h4>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-sm">Surah</p>
                        <p class="text-2xl font-bold text-blue-600 mt-2">Al-Mulk</p>
                        <p class="text-gray-500 text-xs mt-4">30 ayat | Selesai</p>
                    </div>
                </div>

                <!-- Total Santri -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                    <div class="bg-gradient-to-r from-amber-50 to-amber-100 px-6 py-4 border-b border-amber-200">
                        <div class="flex items-center gap-3">
                            <div class="bg-amber-200 p-3 rounded-lg">
                                <i class="fas fa-child text-amber-700 text-lg"></i>
                            </div>
                            <h4 class="font-bold text-amber-800 text-lg">Total Santri</h4>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-sm">Anak Terdaftar</p>
                        <p class="text-4xl font-bold text-amber-600 mt-2">1</p>
                        <p class="text-gray-500 text-xs mt-4">Santri aktif</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-lightning text-green-600"></i>
                    Akses Cepat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <a href="#" class="bg-green-50 hover:bg-green-100 border-2 border-green-200 p-4 rounded-lg transition duration-200 text-center">
                        <i class="fas fa-file-alt text-green-600 text-2xl block mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Laporan Nilai</p>
                    </a>
                    <a href="#" class="bg-blue-50 hover:bg-blue-100 border-2 border-blue-200 p-4 rounded-lg transition duration-200 text-center">
                        <i class="fas fa-calendar text-blue-600 text-2xl block mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Jadwal Belajar</p>
                    </a>
                    <a href="#" class="bg-purple-50 hover:bg-purple-100 border-2 border-purple-200 p-4 rounded-lg transition duration-200 text-center">
                        <i class="fas fa-phone text-purple-600 text-2xl block mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Hubungi Pembina</p>
                    </a>
                    <a href="#" class="bg-amber-50 hover:bg-amber-100 border-2 border-amber-200 p-4 rounded-lg transition duration-200 text-center">
                        <i class="fas fa-bell text-amber-600 text-2xl block mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Pengumuman</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
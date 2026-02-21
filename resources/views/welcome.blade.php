<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Ponpes Modern Syekh Mahmud</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800 scroll-smooth overflow-x-hidden">

    <nav class="sticky top-0 z-50 bg-white/50 backdrop-blur-md shadow-sm" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-emerald-700 flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                    class="h-12 w-auto p-2 bg-emerald-100 rounded-lg" />
                <span>Ponpes Syekh Mahmud</span>
            </div>

            <div class="hidden md:flex space-x-8 font-medium items-center">
                <a href="#pimpinan" class="hover:text-emerald-600 transition">Pimpinan</a>
                <a href="#program" class="hover:text-emerald-600 transition">Program</a>
                <a href="#statistik" class="hover:text-emerald-600 transition">Informasi</a>
                <a href="#kontak" class="hover:text-emerald-600 transition">Kontak</a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('wali.dashboard') }}"
                            class="bg-emerald-600 text-white px-5 py-2 rounded-full font-semibold hover:bg-emerald-700 transition shadow-md">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-emerald-600 transition">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="bg-emerald-600 text-white px-5 py-2 rounded-full font-semibold hover:bg-emerald-700 transition shadow-md">Daftar</a>
                    @endauth
                @endif
            </div>

            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="text-gray-600 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="open" x-transition
            class="md:hidden bg-white border-t border-gray-100 px-6 py-4 space-y-4 shadow-lg">
            <a href="#pimpinan" class="block font-medium text-gray-700">Pimpinan</a>
            <a href="#program" class="block font-medium text-gray-700">Program</a>
            <a href="#statistik" class="block font-medium text-gray-700">Informasi</a>
            <a href="#kontak" class="block font-medium text-gray-700">Kontak</a>
            <hr>
            @auth
                <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('wali.dashboard') }}"
                    class="block font-bold text-emerald-600">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block font-medium text-gray-700">Masuk</a>
                <a href="{{ route('register') }}" class="block font-bold text-emerald-600">Daftar Wali</a>
            @endauth
        </div>
    </nav>

    <header class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 py-16 md:py-15 flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2 text-center md:text-left z-10">
                <span
                    class="bg-emerald-100 text-emerald-700 px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wider">Pendaftaran
                    TA 2026/2027 Dibuka</span>
                <h1 class="text-4xl md:text-6xl font-extrabold mt-6 leading-tight">
                    Mencetak Generasi <br><span class="text-emerald-600 italic">Qur'ani & Mandiri</span>
                </h1>
                <p class="mt-6 text-lg text-gray-600 leading-relaxed max-w-xl">
                    Gabung bersama ribuan santri lainnya dalam lingkungan belajar yang asri, modern, dan menjunjung
                    tinggi nilai-nilai akhlakul karimah.
                </p>
                <div class="mt-10 flex flex-wrap justify-center md:justify-start gap-4">
                    <a href="{{ route('register') }}"
                        class="bg-emerald-600 text-white px-8 py-4 rounded-xl font-bold shadow-xl hover:bg-emerald-700 transition transform hover:-translate-y-1">
                        Daftar Sebagai Wali Santri
                    </a>
                    <a href="#program"
                        class="bg-white border-2 border-emerald-600 text-emerald-600 px-8 py-4 rounded-xl font-bold hover:bg-emerald-50 transition">
                        Lihat Kurikulum
                    </a>

                </div>
            </div>
            <div class="md:w-1/2 relative w-full h-[400px] md:h-[500px]" data-aos="fade-left">
                <div class="absolute top-10 right-10 w-64 h-64 bg-emerald-200 rounded-full blur-3xl opacity-50"></div>

                <div class="relative w-full h-full overflow-hidden">
                    <img src="{{ asset('images/atas.png') }}" alt="Gedung Ponpes" class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-gradient-to-t from-white via-white/10 to-transparent"></div>

                    <div
                        class="hidden md:block absolute inset-0 bg-gradient-to-r from-white via-transparent to-transparent">
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-l from-white/10 via-transparent to-transparent"></div>
                </div>

                <div
                    class="absolute bottom-10 right-10 bg-white/80 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-white/50 z-30">
                    <p class="text-emerald-800 font-bold text-sm">📍 Masjid & Gedung Utama</p>
                </div>
            </div>

        </div>
    </header>

    <section id="pimpinan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="md:w-1/3 relative" data-aos="fade-right">
                    <div class="absolute -bottom-4 -right-4 w-full h-full border-2 border-emerald-600 rounded-2xl">
                    </div>
                    <img src="{{ asset('images/ini.png') }}" alt="Pimpinan"
                        class="relative z-10 rounded-2xl shadow-xl w-full object-cover aspect-[3/4] bg-emerald-900">
                </div>

                <div class="md:w-2/3" data-aos="fade-left">
                    <h4 class="text-emerald-600 font-bold uppercase tracking-widest text-sm">Pendiri Pondok</h4>
                    <h2 class="text-4xl font-extrabold mt-2 mb-6 text-gray-800">Agus Samsi Munawar S.Hi., M.Ap.</h2>
                    <div class="space-y-6 text-lg text-gray-600 italic leading-relaxed">
                        <p>"Assalamu'alaikum Warahmatullahi Wabarakatuh. Fokus kami bukan hanya pada kecerdasan
                            intelektual, tapi pembentukan karakter berdasarkan nilai-nilai Al-Qur'an."</p>
                        <p>"Kami berkomitmen menyediakan lingkungan yang mendukung setiap santri untuk berkembang
                            menjadi pemimpin masa depan yang berakhlak mulia."</p>
                    </div>
                    <div class="mt-8">
                        <img src="{{ asset('images/tanda-tangan.png') }}" alt="Tanda Tangan"
                            class="h-20 opacity-60">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="program" class="py-24 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Program Unggulan</h2>
            <p class="text-gray-600 mb-16 max-w-2xl mx-auto">Kurikulum terintegrasi untuk masa depan santri yang lebih
                cemerlang dan adaptif terhadap zaman.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-modal-program id="tahfidz" title="Tahfidz Qur'an" icon="📖" delay="200"><i
                        class="fa-regular fa-book"></i>
                    Target hafalan 30 juz selama masa pendidikan dengan metode setoran harian.

                    <x-slot:details>
                        <p>Program ini menggunakan metode **Sabaq, Sabqi, dan Manzil** untuk memastikan hafalan kuat
                            (Mutqin).</p>
                        <ul class="list-disc ml-5 space-y-2">
                            <li>Setoran harian setelah Subuh.</li>
                            <li>Murojaah bersama setelah Ashar.</li>
                            <li>Ujian kenaikan juz setiap bulan.</li>
                        </ul>
                    </x-slot:details>
                </x-modal-program>

                <x-modal-program id="it" title="IT Literacy" icon="💻" delay="300">
                    Membekali santri dengan kemampuan coding, desain grafis, dan teknologi digital.

                    <x-slot:details>
                        <p>Santri dipersiapkan menjadi tenaga IT profesional yang berakhlak mulia.</p>
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <div class="bg-gray-50 p-2 rounded border font-semibold text-xs text-center">Web
                                Development</div>
                            <div class="bg-gray-50 p-2 rounded border font-semibold text-xs text-center">UI/UX Design
                            </div>
                            <div class="bg-gray-50 p-2 rounded border font-semibold text-xs text-center">Video Editing
                            </div>
                            <div class="bg-gray-50 p-2 rounded border font-semibold text-xs text-center">Office Pro
                            </div>
                        </div>
                    </x-slot:details>
                </x-modal-program>

                <x-modal-program id="bahasa" title="Kitab Kuning" icon="🗣️" delay="400">
                    Santri di bekali kemampuan untuk membaca kitab kuning dan fasih

                    <x-slot:details>
                        <p>Kami membekali santri dengan kemampuan membaca kitab kuning dan berbahasa Arab dengan fasih.
                        </p>
                        <ul class="list-disc ml-5 space-y-2">
                            <li>Kurikulum kitab kuning yang terstruktur.</li>
                            <li>Latihan membaca dan menulis kitab kuning.</li>
                            <li>Ujian kemampuan kitab kuning setiap kenaikan Eskul.</li>
                        </ul>
                    </x-slot:details>
                </x-modal-program>
            </div>
        </div>
    </section>

    <section id="unit-pendidikan" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-extrabold text-center mb-16 leading-tight">
                Lembaga Pendidikan Dibawah <br><span class="text-emerald-600 italic">Naungan Yayasan Nurul
                    Qur'an</span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                @php
                    $units = [
                        [
                            'title' => 'PP PUTRA & PUTRI',
                            'desc' => 'Pondok Pesantren Syekh Mahmud untuk santri Putra dan Putri.',
                        ],
                        [
                            'title' => 'SMP TERPADU',
                            'desc' => 'SMP Terpadu Diponegoro dengan kurikulum nasional & agama.',
                        ],
                        ['title' => 'SMK TERPADU', 'desc' => 'Pendidikan vokasi dengan keahlian IT & Bisnis Modern.'],
                        [
                            'title' => 'MADRASAH DINIYAH',
                            'desc' => 'Pendalaman kitab kuning dan penguatan ilmu syar\'i.',
                        ],
                    ];
                @endphp

                @foreach ($units as $index => $unit)
                    <div class="group relative bg-gray-50 p-8 rounded-2xl shadow-sm hover:shadow-md hover:bg-green-800 transition group"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div
                            class="group-hover:bg-white group-hover:text-green-800 bg-emerald-700 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg mb-6 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <h3
                            class="group-hover:text-white group-hover:font-bold text-lg font-bold text-gray-800 uppercase mb-3">
                            {{ $unit['title'] }}</h3>
                        <p class="group-hover:text-white text-gray-500 text-sm leading-relaxed">{{ $unit['desc'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="pendaftaran" class="py-16 bg-[#f0f4f8]">
        <div class="max-w-7xl mx-auto px-6">
            <header class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 tracking-wide mb-2">EKTRAKULIKULER</h2>
                <p class="text-sm text-gray-800">
                    HARAP MENGIKUTI EKSTRAKULIKULER <span class="font-bold"> SESUAI DENGAN MINAT DAN BAKAT SANTRI,</span></br>
                    KARENA EKSTRAKULIKULER MERUPAKAN <span class="font-bold">BAGIAN PENTING DALAM MENEMUKAN POTENSI DAN KEMAMPUAN SANTRI</span>
                </p>
                <p class="text sm italic">Catatan: Ekstrakulikuler wajib diikuti oleh seluruh santri, dengan pilihan sesuai minat dan bakat masing-masing.</p> 

            </header>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $eskul = [
                        ['Eskul' => 'HADROH', 'Deskripsi 1' => 'Kurikulum: Pembelajaran variasi pukulan kontemporer, teknik vokal backing vocal, serta persiapan penampilan untuk acara hari besar Islam.', 'Link' => '#'],
                        ['Eskul' => 'FUTSAL', 'Deskripsi 1' => 'Kurikulum: Latihan teknik dasar futsal, strategi permainan, serta partisipasi dalam turnamen antar pesan','Link' => '#'],
                        ['Eskul' => 'QIROAH', 'Deskripsi 1' => 'Kurikulum: Pembelajaran teknik membaca Al-Qur\'an dengan tartil, tajwid, dan makhraj yang benar, serta latihan untuk meningkatkan kefasihan dan keindahan bacaan.', 'Link' => '#'],
                        ['Eskul' => 'SILAT', 'Deskripsi 1' => 'Kurikulum: Latihan teknik dasar silat, strategi pertahanan diri, serta partisipasi dalam turnamen antar pesantren.', 'Link' => '#'],
                    ];
                @endphp

                @foreach ($eskul as $item)
                    <article
                        class="flex flex-col bg-emerald-800 rounded-2xl overflow-hidden shadow-lg border-4 border-emerald-700 transition-transform hover:scale-105 duration-300">
                        <div
                            class="bg-emerald-900 py-5 px-4 text-center text-white font-bold text-sm min-h-[80px] flex items-center justify-center border-b border-emerald-600">
                            EKSTRAKULIKULER {{ $item['Eskul'] }}
                        </div>

                        <div class="p-6 flex-grow text-white space-y-5">
                            <div class="space-y-2">
                               <p class="text-lg font-bold tracking-wide"> KURIKULUM {{ $item['Eskul'] }}</p>
                               <ul class="list-disc ml-5 text-sm text-gray-300">
                                    <li>{{ $item['Deskripsi 1'] }}</li>
                                </ul>
                            </div>

                        </div>
                        <footer class="bg-yellow-300 p-5 text-[#c62828] text-[11px] font-bold leading-snug">
                        <a href="{{ $item['Link'] }}" class="hover:text-[#b71c1c] transition">Selengkapnya</a>
                        </footer>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    <section id="statistik" class="py-20 bg-emerald-700 text-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-10 text-center">
            <div data-aos="fade-up">
                <div class="text-5xl font-extrabold mb-2">{{ $jumlahSantri }}</div>
                <div class="text-emerald-200 uppercase text-xs tracking-widest font-bold">Santri Aktif</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="text-5xl font-extrabold mb-2">45+</div>
                <div class="text-emerald-200 uppercase text-xs tracking-widest font-bold">Ustadz & Pengajar</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <div class="text-5xl font-extrabold mb-2">15</div>
                <div class="text-emerald-200 uppercase text-xs tracking-widest font-bold">Ekstrakurikuler</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-5xl font-extrabold mb-2">300+</div>
                <div class="text-emerald-200 uppercase text-xs tracking-widest font-bold">Alumni Sukses</div>
            </div>
        </div>
    </section>

    <footer id="kontak" class="bg-emerald-900 text-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">

                <div class="col-span-1 md:col-span-1">
                    <div class="text-2xl font-bold text-white mb-4">Ponpes Syekh Mahmud</div>
                    <p class="text-emerald-100/70 text-sm leading-relaxed mb-6">
                        Mencetak generasi rabbani yang unggul dalam ilmu agama dan berwawasan luas sesuai tuntunan
                        Al-Qur'an dan Sunnah.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-emerald-800 rounded-full flex items-center justify-center hover:bg-emerald-600 transition duration-300">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-emerald-800 rounded-full flex items-center justify-center hover:bg-emerald-600 transition duration-300">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-emerald-800 rounded-full flex items-center justify-center hover:bg-emerald-600 transition duration-300">
                            <i class="fab fa-youtube text-sm"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-4">Navigasi</h4>
                    <ul class="space-y-3 text-sm text-emerald-100/70">
                        <li><a href="#" class="hover:text-emerald-400 transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Program Pendidikan</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Info Pendaftaran</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Galeri Kegiatan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-4">Alamat & Kontak</h4>
                    <ul class="space-y-3 text-sm text-emerald-100/70">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-emerald-400"></i>
                            <span>Jl. Pesantren No. 123, Jawa Barat, Indonesia.</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone-alt text-emerald-400"></i>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-emerald-400"></i>
                            <span>info@syekhmahmud.com</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-4">Jam Layanan</h4>
                    <div class="bg-emerald-800/50 p-4 rounded-lg border border-emerald-700">
                        <div class="flex justify-between text-sm mb-2">
                            <span>Senin - Jumat</span>
                            <span>08.00 - 15.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Sabtu</span>
                            <span>08.00 - 12.00</span>
                        </div>
                    </div>
                </div>

            </div>

            <div
                class="pt-8 border-t border-emerald-800 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-emerald-100/50">
                <div>
                    © 2026 <span class="text-white font-medium">Ponpes Syekh Mahmud</span>. All rights reserved.
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-emerald-400 transition">Privacy Policy</a>
                    <a href="#" class="hover:text-emerald-400 transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-8 right-8 bg-emerald-800 text-white p-4 rounded-full shadow-2xl hover:bg-emerald-700 transition-all z-40 transform hover:scale-110 active:scale-95">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
            </path>
        </svg>
    </button>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                once: true
            });

            new Swiper(".myHeroSlider", {
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true
                },
                effect: "fade",
                fadeEffect: {
                    crossFade: true
                }
            });
        });
    </script>
</body>

</html>

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

    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md shadow-sm" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-emerald-700 flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto p-2 bg-emerald-100 rounded-lg" />
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
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-emerald-600 transition">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="bg-emerald-600 text-white px-5 py-2 rounded-full font-semibold hover:bg-emerald-700 transition shadow-md">Daftar</a>
                    @endauth
                @endif
            </div>

            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="text-gray-600 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="open" x-transition class="md:hidden bg-white border-t border-gray-100 px-6 py-4 space-y-4 shadow-lg">
            <a href="#pimpinan" class="block font-medium text-gray-700">Pimpinan</a>
            <a href="#program" class="block font-medium text-gray-700">Program</a>
            <a href="#statistik" class="block font-medium text-gray-700">Informasi</a>
            <a href="#kontak" class="block font-medium text-gray-700">Kontak</a>
            <hr>
            @auth
                <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('wali.dashboard') }}" class="block font-bold text-emerald-600">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block font-medium text-gray-700">Masuk</a>
                <a href="{{ route('register') }}" class="block font-bold text-emerald-600">Daftar Wali</a>
            @endauth
        </div>
    </nav>

    <header class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 py-16 md:py-15 flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2 text-center md:text-left z-10">
                <span class="bg-emerald-100 text-emerald-700 px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wider">Pendaftaran TA 2026/2027 Dibuka</span>
                <h1 class="text-4xl md:text-6xl font-extrabold mt-6 leading-tight">
                    Mencetak Generasi <br><span class="text-emerald-600 italic">Qur'ani & Mandiri</span>
                </h1>
                <p class="mt-6 text-lg text-gray-600 leading-relaxed max-w-xl">
                    Gabung bersama ribuan santri lainnya dalam lingkungan belajar yang asri, modern, dan menjunjung tinggi nilai-nilai akhlakul karimah.
                </p>
                <div class="mt-10 flex flex-wrap justify-center md:justify-start gap-4">
                    <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-8 py-4 rounded-xl font-bold shadow-xl hover:bg-emerald-700 transition transform hover:-translate-y-1">
                        Daftar Sebagai Wali Santri
                    </a>
                    <a href="#program" class="bg-white border-2 border-emerald-600 text-emerald-600 px-8 py-4 rounded-xl font-bold hover:bg-emerald-50 transition">
                        Lihat Kurikulum
                    </a>
                    
                </div>
            </div>
<div class="md:w-1/2 relative w-full h-[400px] md:h-[500px]" data-aos="fade-left">
            <div class="absolute top-10 right-10 w-64 h-64 bg-emerald-200 rounded-full blur-3xl opacity-50"></div>
            
            <div class="relative w-full h-full overflow-hidden">
                <img src="{{ asset('images/atas.png') }}" 
                     alt="Gedung Ponpes" 
                     class="w-full h-full object-cover">
                
                <div class="absolute inset-0 bg-gradient-to-t from-white via-white/10 to-transparent"></div>
                
                <div class="hidden md:block absolute inset-0 bg-gradient-to-r from-white via-transparent to-transparent"></div>
                
                <div class="absolute inset-0 bg-gradient-to-l from-white/10 via-transparent to-transparent"></div>
            </div>

            <div class="absolute bottom-10 right-10 bg-white/80 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-white/50 z-30">
                <p class="text-emerald-800 font-bold text-sm">📍 Masjid & Gedung Utama</p>
            </div>
        </div>

    </div>
    </header>

    <section id="pimpinan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="md:w-1/3 relative" data-aos="fade-right">
                    <div class="absolute -bottom-4 -right-4 w-full h-full border-2 border-emerald-600 rounded-2xl"></div>
                    <img src="{{ asset('images/ini.png') }}" alt="Pimpinan" class="relative z-10 rounded-2xl shadow-xl w-full object-cover aspect-[3/4] bg-emerald-900">
                </div>

                <div class="md:w-2/3" data-aos="fade-left">
                    <h4 class="text-emerald-600 font-bold uppercase tracking-widest text-sm">Pendiri Pondok</h4>
                    <h2 class="text-4xl font-extrabold mt-2 mb-6 text-gray-800">Agus Samsi Munawar S.Hi., M.Ap.</h2>
                    <div class="space-y-6 text-lg text-gray-600 italic leading-relaxed">
                        <p>"Assalamu'alaikum Warahmatullahi Wabarakatuh. Fokus kami bukan hanya pada kecerdasan intelektual, tapi pembentukan karakter berdasarkan nilai-nilai Al-Qur'an."</p>
                        <p>"Kami berkomitmen menyediakan lingkungan yang mendukung setiap santri untuk berkembang menjadi pemimpin masa depan yang berakhlak mulia."</p>
                    </div>
                    <div class="mt-8">
                        <img src="{{ asset('images/tanda-tangan.png') }}" alt="Tanda Tangan" class="h-20 opacity-60">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="program" class="py-24 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Program Unggulan</h2>
            <p class="text-gray-600 mb-16 max-w-2xl mx-auto">Kurikulum terintegrasi untuk masa depan santri yang lebih cemerlang dan adaptif terhadap zaman.</p>
         <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <x-modal-program id="tahfidz" title="Tahfidz Qur'an" icon="📖" delay="200"><i class="fa-regular fa-book"></i>
        Target hafalan 30 juz selama masa pendidikan dengan metode setoran harian.
        
        <x-slot:details>
            <p>Program ini menggunakan metode **Sabaq, Sabqi, dan Manzil** untuk memastikan hafalan kuat (Mutqin).</p>
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
                <div class="bg-gray-50 p-2 rounded border font-semibold text-xs text-center">Web Development</div>
                <div class="bg-gray-50 p-2 rounded border font-semibold text-xs text-center">UI/UX Design</div>
                <div class="bg-gray-50 p-2 rounded border font-semibold text-xs text-center">Video Editing</div>
                <div class="bg-gray-50 p-2 rounded border font-semibold text-xs text-center">Office Pro</div>
            </div>
        </x-slot:details>
    </x-modal-program>

    <x-modal-program id="bahasa" title="Kitab Kuning" icon="🗣️" delay="400">
       Santri di bekali kemampuan untuk membaca kitab kuning dan fasih
        
        <x-slot:details>
            <p>Kami membekali santri dengan kemampuan membaca kitab kuning dan berbahasa Arab dengan fasih.</p>
            <ul class="list-disc ml-5 space-y-2">
                <li>Kurikulum kitab kuning yang terstruktur.</li>
                <li>Latihan membaca dan menulis kitab kuning.</li>
                <li>Ujian kemampuan kitab kuning setiap kenaikan kelas.</li>
            </ul>
        </x-slot:details>
    </x-modal-program>
</div>
        </div>
    </section>

    <section id="unit-pendidikan" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-extrabold text-center mb-16 leading-tight">
                Lembaga Pendidikan Dibawah <br><span class="text-emerald-600 italic">Naungan Yayasan Nurul Qur'an</span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                @php
                    $units = [
                        ['title' => 'PP PUTRA & PUTRI', 'desc' => 'Pondok Pesantren Syekh Mahmud untuk santri Putra dan Putri.'],
                        ['title' => 'SMP TERPADU', 'desc' => 'SMP Terpadu Diponegoro dengan kurikulum nasional & agama.'],
                        ['title' => 'SMK TERPADU', 'desc' => 'Pendidikan vokasi dengan keahlian IT & Bisnis Modern.'],
                        ['title' => 'MADRASAH DINIYAH', 'desc' => 'Pendalaman kitab kuning dan penguatan ilmu syar\'i.']
                    ];
                @endphp

                @foreach ($units as $index => $unit)
                    <div class="group relative bg-gray-50 p-8 rounded-2xl shadow-sm hover:shadow-md hover:bg-green-800 transition group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="group-hover:bg-white group-hover:text-green-800 bg-emerald-700 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg mb-6 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="group-hover:text-white group-hover:font-bold text-lg font-bold text-gray-800 uppercase mb-3">{{ $unit['title'] }}</h3>
                        <p class="group-hover:text-white text-gray-500 text-sm leading-relaxed">{{ $unit['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section x-data="{ showModal: false, activeImg: '', activeTitle: '' }" class="max-w-7xl mx-auto px-6 py-10">
        <div class="swiper myHeroSlider rounded-3xl overflow-hidden shadow-2xl h-[450px] md:h-[550px]">
            <div class="swiper-wrapper">
                <div class="swiper-slide relative cursor-pointer" @click="showModal = true; activeImg = '{{ asset('images/hero1.jpeg') }}'; activeTitle = 'Kegiatan Santri 2026'">
                    <img src="{{ asset('images/hero1.jpeg') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-10 left-10 text-white">
                        <h2 class="text-3xl md:text-4xl font-bold">Membangun Karakter Qur'ani</h2>
                        <p class="text-emerald-400 mt-2">Klik untuk memperbesar foto</p>
                    </div>
                </div>

                <div class="swiper-slide relative cursor-pointer" @click="showModal = true; activeImg = '{{ asset('images/santri1.jpg') }}'; activeTitle = 'Fasilitas Pondok Modern'">
                    <img src="{{ asset('images/santri1.jpg') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-10 left-10 text-white">
                        <h2 class="text-3xl md:text-4xl font-bold">Fasilitas Belajar Modern</h2>
                        <p class="text-emerald-400 mt-2">Lihat dokumentasi fasilitas kami</p>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div x-show="showModal" 
             class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 p-4"
             x-transition:enter="transition duration-300"
             @click.away="showModal = false" style="display: none;">
            <div class="relative max-w-5xl w-full">
                <button @click="showModal = false" class="absolute -top-12 right-0 text-white text-4xl hover:text-emerald-400 transition">&times;</button>
                <img :src="activeImg" class="w-full rounded-xl shadow-2xl border-4 border-white/10">
                <div class="mt-4 text-center">
                    <h3 class="text-white text-2xl font-bold" x-text="activeTitle"></h3>
                </div>
            </div>
        </div>
    </section>

    <section id="statistik" class="py-20 bg-emerald-800 text-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-10 text-center">
            <div data-aos="fade-up">
                <div class="text-5xl font-extrabold mb-2">1,200+</div>
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

    <footer id="kontak" class="bg-white py-12 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-10">
            <div class="text-center md:text-left">
                <div class="text-2xl font-bold text-emerald-800 mb-2">Ponpes Syekh Mahmud</div>
                <p class="text-gray-500 max-w-sm">Jl. Pesantren No. 123, Jawa Barat, Indonesia. <br>Hubungi kami: (021) 1234-5678</p>
            </div>
            <div class="flex space-x-6 text-2xl">
                <a href="#" class="text-gray-400 hover:text-emerald-600 transition">Instagram</a>
                <a href="#" class="text-gray-400 hover:text-red-600 transition">YouTube</a>
                <a href="#" class="text-gray-400 hover:text-blue-600 transition">Facebook</a>
            </div>
            <div class="text-gray-400 text-sm italic">
                © 2026 Ponpes Syekh Mahmud. <br class="md:hidden"> All rights reserved.
            </div>
        </div>
    </footer>

    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-8 right-8 bg-emerald-800 text-white p-4 rounded-full shadow-2xl hover:bg-emerald-700 transition-all z-40 transform hover:scale-110 active:scale-95">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Init AOS
            AOS.init({ duration: 1000, once: true });

            // Init Swiper
            new Swiper(".myHeroSlider", {
                loop: true,
                autoplay: { delay: 4000, disableOnInteraction: false },
                pagination: { el: ".swiper-pagination", clickable: true },
                effect: "fade",
                fadeEffect: { crossFade: true }
            });
        });
    </script>
</body>

</html>
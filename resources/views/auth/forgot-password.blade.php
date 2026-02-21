<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Lupa Kata Sandi?</h2>
        <p class="text-gray-600 text-sm mt-2">
            Jangan khawatir. Cukup masukkan alamat email Anda dan kami akan mengirimkan tautan pengaturan ulang kata sandi.
        </p>
    </div>

{{-- Di halaman Lupa Password --}}
@if(session('status'))
    <x-auth-session-status class="mb-4" status="Alhamdulillah, tautan reset password telah dikirim ke email Anda." />
@endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <i class="fas fa-envelope"></i>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
                    placeholder="nama@email.com" />
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-600 font-medium">
                    <i class="fas fa-exclamation-triangle mr-1"></i> Alamat email tidak ditemukan.
                </p>
            @enderror
        </div>

        <div class="flex flex-col gap-4">
            <button type="submit" 
                class="w-full py-3 px-4 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700 transform active:scale-[0.98] transition duration-200 shadow-md hover:shadow-emerald-200">
                Kirim Tautan Reset
            </button>

            <a href="{{ route('login') }}" 
                class="text-center text-sm font-medium text-emerald-600 hover:text-emerald-700 transition duration-200">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Halaman Masuk
            </a>
        </div>
    </form>
</x-guest-layout>
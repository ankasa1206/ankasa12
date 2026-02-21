<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Daftar</h2>
        <p class="text-gray-600 text-sm mt-2">Buat akun baru untuk mengakses sistem</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
            <p class="text-sm">
                <i class="fas fa-exclamation-circle mr-2"></i>
                Wajib diisi/dipilih/tidak boleh kosong
            </p>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf
        <div>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200 @error('name') border-red-500 @enderror"
                   placeholder="Nama Lengkap" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm" />
        </div>

        <div>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
                   placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
        </div>
        <div class="relative">
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200 @error('password') border-red-500 @enderror"
                   placeholder="Password" />
            <button type="button" onclick="togglePasswordVisibility('password')" class="absolute right-4 top-3.5 text-gray-500 hover:text-gray-700">
                <i class="passwordToggle fas fa-eye"></i>
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
            <p class="text-gray-500 text-xs mt-2">Minimal 8 karakter, kombinasi huruf dan angka</p>
        </div>
        <div class="relative">
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200 @error('password_confirmation') border-red-500 @enderror"
                   placeholder="Konfirmasi Password" />
            <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute right-4 top-3.5 text-gray-500 hover:text-gray-700">
                <i class="passwordToggleConfirm fas fa-eye"></i>
            </button>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm" />
        </div>
        <div class="flex items-start">
            <input type="checkbox" id="agree" class="w-4 h-4 mt-1 rounded border-gray-300 text-green-600 focus:ring-green-500 cursor-pointer" name="agree" required>
            <label for="agree" class="ms-2 text-sm text-gray-700 cursor-pointer">
                Saya setuju dengan <a href="#" class="text-green-600 hover:text-green-700 font-medium">Syarat dan Ketentuan</a>
            </label>
        </div>
        <button type="submit" class="w-full py-3 px-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-200 shadow-md hover:shadow-lg">
            {{ __('Daftar') }}
        </button>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">atau</span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-gray-600 text-sm mb-3">Sudah punya akun?</p>
            <a href="{{ route('login') }}" class="w-full py-3 px-4 border-2 border-green-600 text-green-600 font-semibold rounded-lg hover:bg-green-50 transition duration-200 inline-block">
                {{ __('Masuk') }}
            </a>
        </div>
    </form>

    <script>
        function togglePasswordVisibility(fieldId) {
            const input = document.getElementById(fieldId);
            const toggle = fieldId === 'password' ? document.querySelector('.passwordToggle') : document.querySelector('.passwordToggleConfirm');
            
            if (input.type === 'password') {
                input.type = 'text';
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }
    </script>
</x-guest-layout>

<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Masuk</h2>
    </div>
{{-- Di halaman Login --}}
@if($errors->any())
    <x-auth-session-status class="mb-4" status="Username atau password salah, silahkan periksa kembali." />
@else
    <x-auth-session-status class="mb-4" :status="session('status')" />
@endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf
        <div>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
                   placeholder="Username" />
        </div>

        <div class="relative">
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200 @error('password') border-red-500 @enderror"
                   placeholder="Password" />
            <button type="button" onclick="togglePasswordVisibility()" class="absolute right-4 top-3.5 text-gray-500 hover:text-gray-700">
                <i id="passwordToggle" class="fas fa-eye"></i>
            </button>

            {{-- 3. Memperbaiki pesan di bawah input password --}}
            @error('password')
                <p class="mt-2 text-sm text-red-600">Username atau password salah.</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500" name="remember">
                <span class="ms-2 text-sm text-gray-700">Ingat saya</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-green-600 hover:text-green-700 transition duration-200" href="{{ route('password.request') }}">
                    {{ __('Lupa Kata Sandi?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="w-full py-3 px-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-200 shadow-md hover:shadow-lg">
            {{ __('Masuk') }}
        </button>

        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">atau</span>
            </div>
        </div>

        <div class="text-center">
            <p class="text-gray-600 text-sm mb-3">Belum punya akun?</p>
            <a href="{{ route('register') }}" class="w-full py-3 px-4 border-2 border-green-600 text-green-600 font-semibold rounded-lg hover:bg-green-50 transition duration-200 inline-block text-center">
                {{ __('Daftar') }}
            </a>
        </div>
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                <a href="#" class="text-green-600 hover:text-green-700">Lupa Username?</a>
            </p>
        </div>
    </form>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</x-guest-layout>
<nav class="bg-white border-b border-gray-200 shadow-sm relative z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            {{-- Tombol Sidebar + Logo --}}
            <div class="flex items-center">
              <button @click="toggleSidebar()" 
        class="md:hidden inline-flex items-center justify-center p-2 text-green-800 hover:bg-green-100 focus:outline-none rounded-lg transition-colors">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M4 6h16M4 12h16M4 18h16" />
        <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>

                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 ml-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto" />
                    <div class="hidden md:block">
                        <div class="text-md font-bold text-green-700 leading-tight">PonPes Syekh Mahmud</div>
                    </div>
                </a>
            </div>

            {{-- Dropdown User (Desktop) --}}
            <div class="hidden sm:flex sm:items-center gap-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 px-4 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 focus:outline-none transition rounded-lg">
                            <div class="relative">
                                <i class="fas fa-user-circle text-2xl text-green-600"></i>
                                <div class="absolute bottom-0 right-0 w-2 h-2 bg-green-500 border border-white rounded-full"></div>
                            </div>
                            <div class="text-right hidden md:block">
                                <div class="text-xs font-bold uppercase text-green-600 leading-none">{{ Auth::user()->role }}</div>
                                <div class="text-sm font-semibold text-gray-700 leading-tight">{{ Auth::user()->name }}</div>
                            </div>
                            <i class="fas fa-chevron-down text-xs text-gray-400 ml-1"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 text-sm text-gray-600 border-b border-gray-100">
                            <div class="font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-green-600 uppercase font-bold mt-1">{{ Auth::user()->role }}</div>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                            <i class="fas fa-user-edit text-gray-400 w-4"></i> 
                            <span>{{ __('Edit Profile') }}</span>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" 
                                onclick="event.preventDefault(); this.closest('form').submit();" 
                                class="text-red-600 flex items-center gap-2">
                                <i class="fas fa-sign-out-alt w-4"></i>
                                <span>{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Info User (Mobile) --}}
            <div class="flex items-center sm:hidden">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-2 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 focus:outline-none transition rounded-lg">
                            <div class="relative">
                                <i class="fas fa-user-circle text-2xl text-green-600"></i>
                                <div class="absolute bottom-0 right-0 w-2 h-2 bg-green-500 border border-white rounded-full"></div>
                            </div>
                            <div class="text-left">
                                <div class="text-xs font-bold uppercase text-green-600 leading-none">{{ Auth::user()->role }}</div>
                                <div class="text-xs font-semibold text-gray-700 leading-tight">{{ Auth::user()->name }}</div>
                            </div>
                            <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 text-sm text-gray-600 border-b border-gray-100">
                            <div class="font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-green-600 uppercase font-bold mt-1">{{ Auth::user()->role }}</div>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                            <i class="fas fa-user-edit text-gray-400 w-4"></i> 
                            <span>{{ __('Edit Profile') }}</span>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" 
                                onclick="event.preventDefault(); this.closest('form').submit();" 
                                class="text-red-600 flex items-center gap-2">
                                <i class="fas fa-sign-out-alt w-4"></i>
                                <span>{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

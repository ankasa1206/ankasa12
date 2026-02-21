<aside 
    class="fixed md:static top-0 left-0 z-40 h-screen w-64 bg-green-900 transform transition-transform duration-300 ease-in-out md:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <div class="h-16 flex items-center px-4 bg-green-800 shrink-0 justify-between border-b border-green-700/50">
        <div class="flex items-center overflow-hidden flex-1">
            <img src="{{ asset('images/logo.png') }}" class="w-8 h-8 min-w-[32px]">
            <span class="ml-3 font-bold text-sm tracking-widest whitespace-nowrap uppercase text-white">
                PONPES MAHMUD
            </span>
        </div>
        <button @click="sidebarOpen = false" class="md:hidden text-green-200 hover:text-white hover:bg-green-700 p-1 rounded">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-2 overflow-y-auto custom-scrollbar">
        @php
            $dashRoute = Auth::user()->role == 'admin' ? 'admin.dashboard' : 'wali.dashboard';
        @endphp
        
        <a href="{{ route($dashRoute) }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 
           {{ request()->routeIs('dashboard') ? 'bg-green-700 shadow-md text-white' : 'hover:bg-green-800 text-green-100' }}">
            <i class="fas fa-home text-lg w-5 flex-shrink-0"></i>
            <span class="text-sm font-medium">Dashboard</span>
        </a>

        @if(Auth::user()->role == 'admin')
            <div class="text-[10px] font-bold text-green-400 uppercase px-4 pt-4 pb-2 tracking-widest">
                 Manajemen Santri
            </div>
            
            <a href="{{ route('admin.santri.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 
               {{ request()->routeIs('admin.santri.*') ? 'bg-green-700 text-white shadow-md' : 'hover:bg-green-800 text-green-100' }}">
                <i class="fas fa-users text-lg w-5 flex-shrink-0"></i>
                <span class="text-sm font-medium">Daftar Santri</span>
            </a>
                  
            <a href="{{ route('admin.kelas.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 
               {{ request()->routeIs('admin.kelas.*') ? 'bg-green-700 text-white shadow-md' : 'hover:bg-green-800 text-green-100' }}">
               <i class="fa-solid fa-building-columns"></i>
                <span class="text-sm font-medium">Daftar Kelas</span>
            </a>
            <a href="{{ route('admin.guru.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 
               {{ request()->routeIs('admin.guru.*') ? 'bg-green-700 text-white shadow-md' : 'hover:bg-green-800 text-green-100' }}">
               <i class="fa-solid fa-chalkboard-teacher"></i>
                <span class="text-sm font-medium">Daftar Guru</span>
            </a>
            <a href="{{ route('admin.pendaftaran') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 
               {{ request()->routeIs('admin.pendaftaran') ? 'bg-green-700 text-white shadow-md' : 'hover:bg-green-800 text-green-100' }}">
                <i class="fas fa-user-check text-lg w-5 flex-shrink-0"></i>
                <span class="text-sm font-medium">Verifikasi</span>
            </a>
        @endif
        
        @if(Auth::user()->role == 'wali')
            <a href="{{ route('wali.santri.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 
               {{ request()->routeIs('wali.santri.index') ? 'bg-green-700 text-white shadow-md' : 'hover:bg-green-800 text-green-100' }}">
                <i class="fas fa-users text-lg w-5 flex-shrink-0"></i>
                <span class="text-sm font-medium">Daftar Santri</span>
            </a>
        @endif

        <div class="text-[10px] font-bold text-green-400 uppercase px-4 pt-4 pb-2 tracking-widest">
             Komunikasi
        </div>

        <a href="{{ route('messages.inbox') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 
           {{ request()->routeIs('messages.*') || request()->routeIs('chat.*') ? 'bg-green-700 shadow-md text-white' : 'hover:bg-green-800 text-green-100' }}">
            <i class="fas fa-comments text-lg w-5 flex-shrink-0"></i>
            <span class="text-sm font-medium">Pesan / Chat</span>
        </a>
    </nav>
</aside>

@props(['items' => []])

<div class="flex items-center justify-between"> 
    <div class="flex items-center text-sm font-medium leading-none"> 
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-emerald-700 transition flex items-center">
                    <i class="fas fa-home mr-2"></i> Dashboard Admin
                </a>
            @elseif(auth()->user()->role === 'wali')
                <a href="{{ route('wali.dashboard') }}" class="text-gray-400 hover:text-emerald-700 transition flex items-center">
                    <i class="fas fa-home mr-2"></i> Dashboard Wali
                </a>
            @endif
        @endauth
        
        @foreach($items as $label => $link)
            <span class="mx-2 text-gray-300 flex items-center">/</span>
            @if(!$loop->last)
                <a href="{{ $link }}" class="text-gray-400 hover:text-emerald-700 transition">
                    {{ $label }}
                </a>
            @else
                <span class="text-emerald-800 font-bold">{{ $label }}</span>
            @endif
        @endforeach
    </div>
</div>
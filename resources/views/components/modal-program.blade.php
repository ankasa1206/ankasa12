@props(['id', 'title', 'icon', 'delay' => '200'])

<div x-data="{ open: false }">
    <div @click="open = true" 
         class="group p-8 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center transition-all duration-500 ease-in-out hover:bg-green-600 hover:shadow-md hover:-translate-y-1 cursor-pointer" 
         data-aos="fade-up" 
         data-aos-delay="{{ $delay }}">
        
        <div class="text-5xl mb-6 group-hover:scale-110 transition-transform">{{ $icon }}</div>
        <h3 class="text-xl font-bold mb-4 transition-colors duration-300 group-hover:text-white">{{ $title }}</h3>
        <p class="text-gray-500 leading-relaxed transition-colors duration-300 group-hover:text-green-50">
            {{ $slot }}
        </p>
        <span class="mt-4 text-green-700 font-semibold group-hover:text-white underline text-sm">Selengkapnya</span>
    </div>

    <div x-show="open" 
         class="fixed inset-0 z-[999] overflow-y-auto" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-cloak>
        
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="open = false"></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div @click.away="open = false" 
                 class="relative bg-white rounded-3xl shadow-2xl max-w-lg w-full p-8 transform transition-all"
                 x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                
                <div class="text-center">
                    <div class="text-6xl mb-4">{{ $icon }}</div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-4">{{ $title }}</h3>
                    <div class="text-left text-slate-600 space-y-4">
                        {{ $details }}
                    </div>
                    <button @click="open = false" 
                            class="mt-8 w-full bg-green-700 text-white font-bold py-3 rounded-xl hover:bg-green-800 transition shadow-lg shadow-green-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
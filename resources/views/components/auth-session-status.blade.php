@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-3 mb-4 text-sm rounded-lg border flex items-center shadow-sm ' . 
        ($errors->any() ? 'bg-red-50 border-red-200 text-red-700' : 'bg-emerald-50 border-emerald-200 text-emerald-700')]) }}>
        
        {{-- Ikon otomatis: Tanda seru jika error, Centang jika sukses --}}
        <i class="fas {{ $errors->any() ? 'fa-exclamation-circle' : 'fa-check-circle' }} mr-2"></i>
        
        <span>
            {{ $status }}
        </span>
    </div>
@endif
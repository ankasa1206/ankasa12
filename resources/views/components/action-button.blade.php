@props(['id'])

<div class="flex justify-center gap-2" x-data="{}">
    <a href="{{ route('admin.santri.show', $id) }}" 
       class="text-yellow-600 flex items-center hover:text-yellow-700 bg-yellow-50 px-3 py-1 rounded border border-yellow-200 transition">
        <i class="fas fa-eye mr-1"></i> Detail
    </a>
    <button type="button" 
            x-on:click.prevent="$dispatch('open-modal', 'modal-edit-{{ $id }}')"
            class="text-blue-600 flex items-center hover:text-blue-900 bg-blue-50 px-3 py-1 rounded border border-blue-200 transition">
        <i class="fas fa-edit mr-1"></i> Edit
    </button>
    <button type="button" 
            x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $id }}')"
            class="text-red-600 flex items-center hover:text-red-900 bg-red-50 px-3 py-1 rounded border border-red-200 transition">
        <i class="fas fa-trash-alt mr-1"></i> Hapus
    </button>
</div>
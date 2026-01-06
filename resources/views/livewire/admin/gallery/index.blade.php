<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <flux:heading size="xl">Manajemen Galeri</flux:heading>
        <flux:button href="{{ route('admin.gallery.create') }}" variant="primary" icon="plus">Tambah Galeri</flux:button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($galleries as $item)
            <flux:card class="space-y-4" wire:key="{{ $item->id }}">
                <div class="aspect-video bg-zinc-100 dark:bg-zinc-800 rounded-lg overflow-hidden flex items-center justify-center relative group">
                    @if($item->getFirstMediaUrl('gallery'))
                        @if($item->type === 'video')
                            <video src="{{ $item->getFirstMediaUrl('gallery') }}" class="w-full h-full object-cover" controls></video>
                        @else
                            <img src="{{ $item->getFirstMediaUrl('gallery') }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        @endif
                    @else
                        <flux:icon name="photo" class="text-zinc-400 w-12 h-12" />
                    @endif

                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                         <flux:button wire:click="delete({{ $item->id }})" variant="danger" size="sm" icon="trash" wire:confirm="Hapus item ini?">Hapus</flux:button>
                    </div>
                </div>

                <div>
                    <flux:heading size="lg" class="truncate">{{ $item->title }}</flux:heading>
                    <flux:subheading class="line-clamp-2">{{ $item->description }}</flux:subheading>
                </div>

                <div class="flex items-center justify-between">
                    <flux:badge size="sm" color="{{ $item->is_published ? 'green' : 'zinc' }}">{{ $item->is_published ? 'Published' : 'Draft' }}</flux:badge>
                    <span class="text-xs text-zinc-500">{{ $item->type === 'video' ? 'Video' : 'Foto' }}</span>
                </div>
            </flux:card>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $galleries->links() }}
    </div>
</div>
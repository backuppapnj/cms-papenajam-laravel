<div class="py-12 bg-zinc-50 dark:bg-zinc-900 min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Header Halaman -->
        <div class="mb-12 text-center">
            <flux:heading size="xl" class="mb-2">Galeri Kegiatan</flux:heading>
            <flux:subheading>Dokumentasi visual kegiatan Pengadilan Agama Penajam</flux:subheading>
        </div>

        <!-- Filter -->
        <div class="flex justify-center mb-12">
            <flux:radio.group wire:model.live="type" variant="segmented">
                <flux:radio value="" label="Semua" />
                <flux:radio value="image" label="Foto" />
                <flux:radio value="video" label="Video" />
            </flux:radio.group>
        </div>

        @if($galleries->isEmpty())
            <div class="bg-white dark:bg-zinc-800 rounded-xl p-12 text-center shadow-sm">
                <flux:icon name="photo" class="w-12 h-12 text-zinc-400 mx-auto mb-4" />
                <flux:heading size="lg">Belum ada koleksi</flux:heading>
                <flux:subheading>Koleksi galeri akan segera kami perbarui.</flux:subheading>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($galleries as $item)
                    <div x-data="{ open: false }" class="group">
                        <flux:card class="!p-0 overflow-hidden cursor-pointer shadow-sm hover:shadow-lg transition duration-300 h-full flex flex-col" x-on:click="open = true">
                            <div class="aspect-square relative overflow-hidden bg-zinc-200 dark:bg-zinc-800 flex items-center justify-center">
                                @if($item->getFirstMediaUrl('gallery'))
                                    @if($item->type === 'video')
                                        <!-- Video Thumbnail (Placeholder icon for now or actual video) -->
                                        <video src="{{ $item->getFirstMediaUrl('gallery') }}" class="w-full h-full object-cover"></video>
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/40 transition">
                                            <div class="w-12 h-12 bg-white/90 rounded-full flex items-center justify-center shadow-lg">
                                                <flux:icon name="play" class="text-green-700 w-6 h-6 ml-1" variant="solid" />
                                            </div>
                                        </div>
                                    @else
                                        <img src="{{ $item->getFirstMediaUrl('gallery') }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @endif
                                @endif
                                
                                <div class="absolute top-3 right-3">
                                    <flux:badge size="sm" class="!bg-black/50 !text-white backdrop-blur-md border-none">
                                        {{ $item->type === 'video' ? 'Video' : 'Foto' }}
                                    </flux:badge>
                                </div>
                            </div>
                            <div class="p-4 bg-white dark:bg-zinc-800">
                                <h3 class="font-bold text-sm line-clamp-2">{{ $item->title }}</h3>
                            </div>
                        </flux:card>

                        <!-- Simple Lightbox Modal -->
                        <div x-show="open" 
                             x-cloak
                             class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm"
                             x-on:keydown.escape.window="open = false">
                            
                            <button x-on:click="open = false" class="absolute top-6 right-6 text-white hover:text-zinc-300 z-[110]">
                                <flux:icon name="x-mark" class="w-8 h-8" />
                            </button>

                            <div class="max-w-5xl w-full flex flex-col items-center gap-6" x-on:click.away="open = false">
                                @if($item->type === 'video')
                                    <video src="{{ $item->getFirstMediaUrl('gallery') }}" class="w-full max-h-[80vh] rounded-lg shadow-2xl" controls autoplay></video>
                                @else
                                    <img src="{{ $item->getFirstMediaUrl('gallery') }}" class="max-w-full max-h-[80vh] rounded-lg shadow-2xl object-contain">
                                @endif
                                
                                <div class="text-center text-white max-w-2xl">
                                    <h2 class="text-2xl font-bold mb-2">{{ $item->title }}</h2>
                                    <p class="text-zinc-400">{{ $item->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>
</div>

<div class="py-12 bg-zinc-50 dark:bg-zinc-900 min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Header Halaman -->
        <div class="mb-12 text-center">
            <flux:heading size="xl" class="mb-2">Arsip Berita & Pengumuman</flux:heading>
            <flux:subheading>Temukan informasi terbaru dari Pengadilan Agama Penajam</flux:subheading>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Konten Utama (Grid Berita) -->
            <div class="lg:w-2/3">
                <!-- Filter & Search -->
                <div class="flex flex-col md:flex-row gap-4 mb-8">
                    <div class="flex-grow">
                        <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Cari berita..." />
                    </div>
                    <div class="w-full md:w-48">
                        <flux:select wire:model.live="category" placeholder="Semua Kategori">
                            <flux:select.option value="">Semua</flux:select.option>
                            <flux:select.option value="Berita">Berita</flux:select.option>
                            <flux:select.option value="Pengumuman">Pengumuman</flux:select.option>
                            <flux:select.option value="Kegiatan">Kegiatan</flux:select.option>
                        </flux:select>
                    </div>
                </div>

                @if($news->isEmpty())
                    <div class="bg-white dark:bg-zinc-800 rounded-xl p-12 text-center shadow-sm">
                        <flux:icon name="information-circle" class="w-12 h-12 text-zinc-400 mx-auto mb-4" />
                        <flux:heading size="lg">Berita tidak ditemukan</flux:heading>
                        <flux:subheading>Coba gunakan kata kunci pencarian lain.</flux:subheading>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($news as $item)
                            <flux:card class="overflow-hidden !p-0 group flex flex-col h-full shadow-sm hover:shadow-md transition">
                                <a href="{{ route('public.news.show', $item->slug) }}" class="aspect-video relative overflow-hidden block">
                                    @if($item->getFirstMediaUrl('images'))
                                        <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="w-full h-full bg-zinc-200 dark:bg-zinc-800 flex items-center justify-center">
                                            <flux:icon name="photo" class="w-12 h-12 text-zinc-400" />
                                        </div>
                                    @endif
                                </a>
                                <div class="p-6 flex flex-col flex-grow">
                                    <div class="flex items-center gap-2 mb-3">
                                        <flux:badge size="sm" color="green">Berita</flux:badge>
                                        <span class="text-xs text-zinc-500">{{ $item->published_at?->format('d M Y') }}</span>
                                    </div>
                                    <a href="{{ route('public.news.show', $item->slug) }}" class="block">
                                        <h3 class="text-lg font-bold mb-3 line-clamp-2 hover:text-green-700 dark:hover:text-green-400 transition">{{ $item->title }}</h3>
                                    </a>
                                    <p class="text-zinc-600 dark:text-zinc-400 text-sm line-clamp-3 mb-4 flex-grow">
                                        {{ Str::limit(strip_tags($item->content), 100) }}
                                    </p>
                                    <flux:button href="{{ route('public.news.show', $item->slug) }}" variant="ghost" size="sm" class="self-start !p-0 hover:!bg-transparent text-green-700 dark:text-green-400 font-semibold">Baca Selengkapnya &rarr;</flux:button>
                                </div>
                            </flux:card>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $news->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3 space-y-12">
                <!-- Berita Populer -->
                <section>
                    <flux:heading size="lg" class="mb-6 border-b border-zinc-200 dark:border-zinc-700 pb-2">Berita Populer</flux:heading>
                    <div class="space-y-6">
                        @foreach($popularNews as $pop)
                            <div class="flex gap-4 group">
                                <a href="{{ route('public.news.show', $pop->slug) }}" class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-zinc-200">
                                    @if($pop->getFirstMediaUrl('images'))
                                        <img src="{{ $pop->getFirstMediaUrl('images') }}" class="w-full h-full object-cover group-hover:scale-110 transition" alt="">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <flux:icon name="photo" size="sm" class="text-zinc-400" />
                                        </div>
                                    @endif
                                </a>
                                <div class="flex flex-col justify-center">
                                    <a href="{{ route('public.news.show', $pop->slug) }}" class="text-sm font-bold line-clamp-2 group-hover:text-green-700 dark:group-hover:text-green-400 transition">{{ $pop->title }}</a>
                                    <span class="text-xs text-zinc-500 mt-1">{{ $pop->published_at?->format('d M Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Tautan Terkait -->
                <section>
                    <flux:heading size="lg" class="mb-6 border-b border-zinc-200 dark:border-zinc-700 pb-2">Tautan Terkait</flux:heading>
                    <ul class="space-y-3">
                        <li><flux:link href="#" class="flex items-center gap-2"><flux:icon name="chevron-right" size="xs" /> Mahkamah Agung RI</flux:link></li>
                        <li><flux:link href="#" class="flex items-center gap-2"><flux:icon name="chevron-right" size="xs" /> Dirjen Badilag</flux:link></li>
                        <li><flux:link href="#" class="flex items-center gap-2"><flux:icon name="chevron-right" size="xs" /> PTA Samarinda</flux:link></li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</div>

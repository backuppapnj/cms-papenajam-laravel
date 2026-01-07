<div class="py-12 bg-white dark:bg-zinc-900 min-h-screen">
    <article class="container mx-auto px-4 max-w-5xl">
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-zinc-500 mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="/" class="hover:text-green-700 transition">Beranda</a></li>
                <flux:icon name="chevron-right" size="xs" />
                <li><a href="{{ route('public.news.index') }}" class="hover:text-green-700 transition">Berita</a></li>
                <flux:icon name="chevron-right" size="xs" />
                <li class="text-zinc-900 dark:text-zinc-100 font-medium truncate max-w-[200px] sm:max-w-md">{{ $news->title }}</li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Konten Utama -->
            <div class="lg:w-2/3">
                <header class="mb-8">
                    <div class="flex items-center gap-3 mb-4 text-sm text-zinc-500">
                        <flux:badge color="green">Berita</flux:badge>
                        <span>{{ $news->published_at?->format('d F Y') }}</span>
                        <span>&bull;</span>
                        <span>Oleh: Admin</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-zinc-900 dark:text-white leading-tight mb-6">
                        {{ $news->title }}
                    </h1>
                </header>

                @if($news->getFirstMediaUrl('images'))
                    <div class="rounded-2xl overflow-hidden mb-10 shadow-lg border border-zinc-100 dark:border-zinc-800">
                        <img src="{{ $news->getFirstMediaUrl('images') }}" alt="{{ $news->title }}" class="w-full h-auto object-cover max-h-[500px]">
                    </div>
                @endif

                <div class="prose prose-lg dark:prose-invert max-w-none text-zinc-700 dark:text-zinc-300 leading-relaxed mb-12">
                    {!! nl2br($news->content) !!}
                </div>

                <!-- Bagian Bagikan & Cetak -->
                <div class="border-y border-zinc-100 dark:border-zinc-800 py-6 mb-12 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <span class="font-semibold text-zinc-900 dark:text-white">Bagikan:</span>
                        <div class="flex gap-2">
                            <flux:button icon="share" variant="subtle" size="sm" />
                            <!-- Placeholder icons for specific socials -->
                            <flux:button variant="subtle" size="sm">WA</flux:button>
                            <flux:button variant="subtle" size="sm">FB</flux:button>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <flux:button icon="printer" variant="subtle" size="sm" onclick="window.print()">Cetak Halaman</flux:button>
                    </div>
                </div>

                <!-- Navigasi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @if($previousNews)
                        <flux:button href="{{ route('public.news.show', $previousNews->slug) }}" variant="ghost" class="justify-start h-auto py-4">
                            <div class="text-left overflow-hidden">
                                <div class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Berita Sebelumnya</div>
                                <div class="font-bold truncate text-zinc-900 dark:text-white">{{ $previousNews->title }}</div>
                            </div>
                        </flux:button>
                    @else
                        <div></div>
                    @endif

                    @if($nextNews)
                        <flux:button href="{{ route('public.news.show', $nextNews->slug) }}" variant="ghost" class="justify-end text-right h-auto py-4">
                            <div class="text-right overflow-hidden">
                                <div class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Berita Selanjutnya</div>
                                <div class="font-bold truncate text-zinc-900 dark:text-white">{{ $nextNews->title }}</div>
                            </div>
                        </flux:button>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <flux:heading size="lg" class="mb-6 border-b border-zinc-200 dark:border-zinc-700 pb-2">Berita Terbaru</flux:heading>
                <div class="space-y-6">
                    @foreach($recentNews as $recent)
                        <div class="flex gap-4 group">
                            <a href="{{ route('public.news.show', $recent->slug) }}" class="w-16 h-16 flex-shrink-0 rounded-lg overflow-hidden bg-zinc-200">
                                @if($recent->getFirstMediaUrl('images'))
                                    <img src="{{ $recent->getFirstMediaUrl('images') }}" class="w-full h-full object-cover group-hover:scale-110 transition" alt="">
                                @endif
                            </a>
                            <div class="flex flex-col justify-center">
                                <a href="{{ route('public.news.show', $recent->slug) }}" class="text-sm font-bold line-clamp-2 group-hover:text-green-700 dark:group-hover:text-green-400 transition">{{ $recent->title }}</a>
                                <span class="text-xs text-zinc-500 mt-1">{{ $recent->published_at?->format('d M Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </article>
</div>

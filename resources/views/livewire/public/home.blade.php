<div>
    <!-- Hero Section -->
    <section class="relative bg-zinc-900 text-white h-[500px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-zinc-900/80 z-10"></div>
        <!-- Placeholder Image -->
        <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=2070&auto=format&fit=crop" alt="Pengadilan" class="absolute inset-0 w-full h-full object-cover">
        
        <div class="relative z-20 container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Selamat Datang di Pengadilan Agama Penajam</h1>
            <p class="text-xl md:text-2xl text-zinc-200 mb-8 max-w-2xl mx-auto">Mewujudkan Peradilan yang Agung, Modern, dan Melayani Sepenuh Hati.</p>
            <div class="flex justify-center gap-4">
                <flux:button variant="primary">Jadwal Sidang</flux:button>
                <flux:button variant="filled">Layanan Perkara</flux:button>
            </div>
        </div>
    </section>

    <!-- Sambutan Ketua -->
    <section class="py-16 bg-white dark:bg-zinc-800">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/3">
                    <div class="aspect-[3/4] bg-zinc-200 rounded-lg overflow-hidden shadow-xl">
                        <!-- Placeholder Foto Ketua -->
                        <img src="https://placehold.co/400x533?text=Foto+Ketua" alt="Ketua Pengadilan" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="w-full md:w-2/3">
                    <flux:heading size="xl" class="mb-4 text-green-700">Sambutan Ketua Pengadilan</flux:heading>
                    <div class="prose dark:prose-invert text-zinc-600 dark:text-zinc-300">
                        <p class="mb-4">
                            Assalamu’alaikum Warahmatullahi Wabarakatuh.
                        </p>
                        <p class="mb-4">
                            Puji syukur kita panjatkan ke hadirat Allah SWT. Website ini merupakan wujud komitmen kami dalam memberikan pelayanan prima dan transparansi informasi kepada masyarakat pencari keadilan.
                        </p>
                        <p>
                            Kami berharap website ini dapat memudahkan akses informasi mengenai prosedur berperkara, jadwal sidang, dan layanan lainnya tanpa harus datang langsung ke kantor pengadilan.
                        </p>
                        <div class="mt-8 font-bold text-zinc-900 dark:text-zinc-100">
                            Nama Ketua Pengadilan, S.H.I., M.H.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links -->
    <section class="py-12 bg-zinc-50 dark:bg-zinc-900">
        <div class="container mx-auto px-4">
            <flux:heading size="lg" class="text-center mb-8">Akses Cepat Layanan</flux:heading>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach(['SIPP' => 'server', 'e-Court' => 'computer-desktop', 'Jadwal Sidang' => 'calendar', 'Biaya Perkara' => 'calculator'] as $label => $icon)
                    <flux:card class="flex flex-col items-center justify-center p-6 hover:bg-green-50 dark:hover:bg-green-900/20 transition cursor-pointer text-center space-y-3 group">
                        <div class="p-4 bg-green-100 dark:bg-green-900/50 rounded-full group-hover:scale-110 transition duration-300">
                            <flux:icon :name="$icon" class="w-8 h-8 text-green-700 dark:text-green-400" />
                        </div>
                        <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $label }}</span>
                    </flux:card>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Widget Jadwal Sholat -->
    <section class="py-12 bg-white dark:bg-zinc-800 border-y border-zinc-200 dark:border-zinc-700">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-green-700 rounded-2xl p-8 text-white shadow-lg overflow-hidden relative">
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-green-600 rounded-full opacity-20"></div>
                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <div>
                            <flux:heading size="lg" class="!text-white mb-1 text-center md:text-left">Jadwal Sholat</flux:heading>
                            <flux:subheading class="!text-green-100 text-center md:text-left">Penajam Paser Utara dan sekitarnya</flux:subheading>
                        </div>
                        <div class="grid grid-cols-3 sm:grid-cols-6 gap-4 text-center">
                            @foreach(['Subuh' => '04:45', 'Terbit' => '06:05', 'Dzuhur' => '12:15', 'Ashar' => '15:40', 'Maghrib' => '18:20', 'Isya' => '19:30'] as $sholat => $waktu)
                                <div class="bg-white/10 rounded-lg p-3 backdrop-blur-sm">
                                    <div class="text-xs uppercase tracking-wider text-green-200 mb-1 font-semibold">{{ $sholat }}</div>
                                    <div class="text-lg font-bold">{{ $waktu }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="py-16 bg-zinc-50 dark:bg-zinc-900">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <flux:heading size="xl">Berita Terbaru</flux:heading>
                    <flux:subheading>Informasi terkini seputar Pengadilan Agama Penajam</flux:subheading>
                </div>
                <flux:button variant="subtle" href="#">Lihat Semua Berita</flux:button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestNews as $news)
                    <flux:card class="overflow-hidden !p-0 group flex flex-col h-full">
                        <div class="aspect-video relative overflow-hidden">
                            @if($news->getFirstMediaUrl('images'))
                                <img src="{{ $news->getFirstMediaUrl('images') }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full bg-zinc-200 dark:bg-zinc-800 flex items-center justify-center">
                                    <flux:icon name="photo" class="w-12 h-12 text-zinc-400" />
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <flux:badge color="green">Berita</flux:badge>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="text-xs text-zinc-500 mb-2">{{ $news->published_at?->format('d M Y') }}</div>
                            <h3 class="text-lg font-bold mb-3 line-clamp-2 group-hover:text-green-700 dark:group-hover:text-green-400 transition cursor-pointer">{{ $news->title }}</h3>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm line-clamp-3 mb-4 flex-grow">
                                {{ Str::limit(strip_tags($news->content), 120) }}
                            </p>
                            <flux:button variant="ghost" size="sm" class="self-start !p-0 hover:!bg-transparent text-green-700 dark:text-green-400 font-semibold group-hover:translate-x-1 transition duration-300">Baca Selengkapnya &rarr;</flux:button>
                        </div>
                    </flux:card>
                @endforeach
            </div>
        </div>
    </section>
</div>
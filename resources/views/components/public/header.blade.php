<header class="bg-white dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-700 sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-3">
                <a href="/" class="flex items-center gap-2">
                    <flux:icon name="building-library" class="w-8 h-8 text-green-700" />
                    <span class="font-bold text-lg text-zinc-900 dark:text-zinc-100 hidden sm:block">Pengadilan Agama Penajam</span>
                </a>
            </div>

            <!-- Navigation (Desktop) -->
            <nav class="hidden md:flex space-x-8">
                <flux:navbar.item href="/" :active="request()->is('/')">Beranda</flux:navbar.item>
                <flux:navbar.item href="#">Profil</flux:navbar.item>
                <flux:navbar.item href="#">Berita</flux:navbar.item>
                <flux:navbar.item href="#">Layanan</flux:navbar.item>
                <flux:navbar.item href="#">Galeri</flux:navbar.item>
                <flux:navbar.item href="#">Kontak</flux:navbar.item>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden">
                <flux:button icon="bars-3" variant="ghost" />
            </div>
        </div>
    </div>
</header>

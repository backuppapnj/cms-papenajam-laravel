<div class="py-12 bg-zinc-50 dark:bg-zinc-900 min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Header Halaman -->
        <div class="mb-16 text-center max-w-2xl mx-auto">
            <flux:heading size="xl" class="mb-4">Struktur Organisasi</flux:heading>
            <flux:subheading>Susunan pejabat dan personel Pengadilan Agama Penajam yang berdedikasi melayani masyarakat.</flux:subheading>
        </div>

        @if($officers->isEmpty())
            <div class="bg-white dark:bg-zinc-800 rounded-xl p-12 text-center shadow-sm max-w-4xl mx-auto">
                <flux:icon name="users" class="w-12 h-12 text-zinc-400 mx-auto mb-4" />
                <flux:heading size="lg">Data personel belum tersedia</flux:heading>
                <flux:subheading>Data struktur organisasi akan segera kami perbarui.</flux:subheading>
            </div>
        @else
            <!-- Hierarchy Display -->
            @foreach($officers->groupBy('level') as $level => $members)
                <div class="mb-16">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 justify-center items-center">
                        @foreach($members as $officer)
                            <flux:card class="p-0 overflow-hidden text-center shadow-sm border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 flex flex-col items-center">
                                <div class="w-full aspect-square bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center overflow-hidden">
                                    @if($officer->getFirstMediaUrl('officers'))
                                        <img src="{{ $officer->getFirstMediaUrl('officers') }}" alt="{{ $officer->name }}" class="w-full h-full object-cover">
                                    @else
                                        <flux:icon name="user" class="w-24 h-24 text-zinc-300" />
                                    @endif
                                </div>
                                <div class="p-6 w-full">
                                    <h3 class="font-bold text-lg text-zinc-900 dark:text-zinc-100 mb-1 leading-tight">{{ $officer->name }}</h3>
                                    <div class="text-sm font-medium text-green-700 dark:text-green-400 uppercase tracking-wider mb-2">
                                        {{ $officer->position }}
                                    </div>
                                </div>
                            </flux:card>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

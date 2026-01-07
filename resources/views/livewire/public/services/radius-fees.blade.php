<div class="py-12 bg-zinc-50 dark:bg-zinc-900 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">
        <header class="mb-12 text-center">
            <flux:heading size="xl" class="mb-2">Radius & Biaya Panjar</flux:heading>
            <flux:subheading>Transparansi estimasi biaya panjar perkara berdasarkan wilayah.</flux:subheading>
        </header>

        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="p-6 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-900/50 flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="flex-grow w-full md:w-auto">
                    <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Cari wilayah / kelurahan..." />
                </div>
                <div class="flex items-center gap-2 text-zinc-500 text-sm">
                    <flux:icon name="information-circle" size="sm" />
                    <span>Data diperbarui secara berkala</span>
                </div>
            </div>

            @if($fees->isEmpty())
                <div class="p-12 text-center">
                    <flux:icon name="magnifying-glass" class="w-12 h-12 text-zinc-400 mx-auto mb-4" />
                    <flux:heading size="lg">Data tidak ditemukan</flux:heading>
                    <flux:subheading>Silakan gunakan kata kunci lain.</flux:subheading>
                </div>
            @else
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>Wilayah / Kelurahan</flux:table.column>
                        <flux:table.column>Radius</flux:table.column>
                        <flux:table.column>Estimasi Biaya</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        @foreach($fees as $item)
                            <flux:table.row wire:key="{{ $item->id }}">
                                <flux:table.cell class="font-bold text-zinc-900 dark:text-zinc-100">
                                    {{ $item->region }}
                                </flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge size="sm" color="zinc" variant="outline">{{ $item->radius }}</flux:badge>
                                </flux:table.cell>
                                <flux:table.cell class="text-green-700 dark:text-green-400 font-bold">
                                    Rp {{ number_format($item->fee, 0, ',', '.') }}
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>

                <div class="p-6 border-t border-zinc-200 dark:border-zinc-700">
                    {{ $fees->links() }}
                </div>
            @endif
        </div>

        <div class="mt-8 p-6 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-100 dark:border-green-900/30">
            <div class="flex gap-4">
                <flux:icon name="document-text" class="text-green-700 dark:text-green-400 flex-shrink-0" />
                <div class="text-sm text-green-800 dark:text-green-300">
                    <p class="font-bold mb-1 text-base">Catatan Penting:</p>
                    <p>Biaya di atas adalah **estimasi panjar**. Biaya riil bergantung pada jumlah proses persidangan dan pemanggilan para pihak. Sisa panjar akan dikembalikan kepada pemohon/penggugat setelah perkara putus.</p>
                </div>
            </div>
        </div>
    </div>
</div>

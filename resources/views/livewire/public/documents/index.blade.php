<div class="py-12 bg-zinc-50 dark:bg-zinc-900 min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Header Halaman -->
        <div class="mb-12 text-center">
            <flux:heading size="xl" class="mb-2">Pusat Unduhan</flux:heading>
            <flux:subheading>Akses dokumen publik, formulir, dan regulasi penting</flux:subheading>
        </div>

        <div class="max-w-5xl mx-auto bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <!-- Search Bar -->
            <div class="p-6 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-900/50">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Cari judul dokumen atau kategori..." />
            </div>

            @if($documents->isEmpty())
                <div class="p-12 text-center">
                    <flux:icon name="document-text" class="w-12 h-12 text-zinc-400 mx-auto mb-4" />
                    <flux:heading size="lg">Dokumen tidak ditemukan</flux:heading>
                    <flux:subheading>Silakan gunakan kata kunci lain.</flux:subheading>
                </div>
            @else
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>Nama Dokumen</flux:table.column>
                        <flux:table.column>Kategori</flux:table.column>
                        <flux:table.column class="hidden md:table-cell">Tipe</flux:table.column>
                        <flux:table.column class="hidden sm:table-cell">Unduhan</flux:table.column>
                        <flux:table.column></flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        @foreach($documents as $doc)
                            <flux:table.row wire:key="{{ $doc->id }}">
                                <flux:table.cell>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-zinc-900 dark:text-zinc-100 leading-tight mb-1">{{ $doc->title }}</span>
                                        <span class="text-xs text-zinc-500 md:hidden">{{ $doc->category }}</span>
                                    </div>
                                </flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge size="sm" color="zinc" variant="outline">{{ $doc->category ?? 'Umum' }}</flux:badge>
                                </flux:table.cell>
                                <flux:table.cell class="hidden md:table-cell text-zinc-500 uppercase text-xs font-bold">
                                    {{ $doc->getFirstMedia('documents')?->extension ?? '-' }}
                                </flux:table.cell>
                                <flux:table.cell class="hidden sm:table-cell">
                                    <div class="flex items-center gap-1 text-zinc-500 text-sm">
                                        <flux:icon name="arrow-down-tray" size="xs" />
                                        {{ $doc->download_count }}
                                    </div>
                                </flux:table.cell>
                                <flux:table.cell>
                                    <flux:button wire:click="download({{ $doc->id }})" variant="primary" size="sm" icon="arrow-down-tray">
                                        Unduh
                                    </flux:button>
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>

                <div class="p-6 border-t border-zinc-200 dark:border-zinc-700">
                    {{ $documents->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

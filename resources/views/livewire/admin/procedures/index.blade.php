<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <flux:heading size="xl">Prosedur Berperkara</flux:heading>
            <flux:subheading>Atur panduan alur perkara untuk masyarakat.</flux:subheading>
        </div>
        <flux:button href="{{ route('admin.procedures.create') }}" variant="primary" icon="plus">Tambah Prosedur</flux:button>
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Judul</flux:table.column>
            <flux:table.column>Infografis</flux:table.column>
            <flux:table.column>Aksi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach($procedures as $item)
                <flux:table.row wire:key="{{ $item->id }}">
                    <flux:table.cell class="font-medium">{{ $item->title }}</flux:table.cell>
                    <flux:table.cell>
                        @if($item->getFirstMediaUrl('infographics'))
                            <flux:icon name="photo" class="text-green-600" />
                        @else
                            <span class="text-zinc-400">-</span>
                        @endif
                    </flux:table.cell>
                    <flux:table.cell>
                        <flux:dropdown>
                            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" />

                            <flux:menu>
                                <flux:menu.item href="{{ route('admin.procedures.edit', $item) }}" icon="pencil-square">Edit</flux:menu.item>
                                <flux:menu.item wire:click="delete({{ $item->id }})" icon="trash" variant="danger" wire:confirm="Hapus prosedur ini?">Hapus</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <div class="mt-4">
        {{ $procedures->links() }}
    </div>
</div>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <flux:heading size="xl">Struktur Organisasi</flux:heading>
            <flux:subheading>Manajemen pejabat dan personel instansi.</flux:subheading>
        </div>
        <flux:button href="{{ route('admin.officers.create') }}" variant="primary" icon="plus">Tambah Pejabat</flux:button>
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Foto</flux:table.column>
            <flux:table.column>Nama</flux:table.column>
            <flux:table.column>Jabatan</flux:table.column>
            <flux:table.column>Level/Urutan</flux:table.column>
            <flux:table.column>Aksi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach($officers as $officer)
                <flux:table.row wire:key="{{ $officer->id }}">
                    <flux:table.cell>
                        @if($officer->getFirstMediaUrl('officers'))
                            <img src="{{ $officer->getFirstMediaUrl('officers') }}" alt="{{ $officer->name }}" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-zinc-200 flex items-center justify-center">
                                <flux:icon name="user" class="w-6 h-6 text-zinc-400" />
                            </div>
                        @endif
                    </flux:table.cell>
                    <flux:table.cell class="font-medium">{{ $officer->name }}</flux:table.cell>
                    <flux:table.cell>{{ $officer->position }}</flux:table.cell>
                    <flux:table.cell>Level {{ $officer->level }} / Order {{ $officer->order }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:dropdown>
                            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" />

                            <flux:menu>
                                <flux:menu.item href="{{ route('admin.officers.edit', $officer) }}" icon="pencil-square">Edit</flux:menu.item>
                                <flux:menu.item wire:click="delete({{ $officer->id }})" icon="trash" variant="danger" wire:confirm="Hapus pejabat ini?">Hapus</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <div class="mt-4">
        {{ $officers->links() }}
    </div>
</div>

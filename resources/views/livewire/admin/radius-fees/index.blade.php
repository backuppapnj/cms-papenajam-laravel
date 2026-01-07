<div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Form Section -->
    <div class="lg:col-span-1">
        <flux:card>
            <div class="mb-6">
                <flux:heading size="lg">{{ $isEditing ? 'Edit Biaya' : 'Tambah Biaya Radius' }}</flux:heading>
                <flux:subheading>Atur data biaya panjar per wilayah.</flux:subheading>
            </div>

            <form wire:submit="save" class="space-y-4">
                <flux:input wire:model="form.region" label="Wilayah / Kelurahan" placeholder="Misal: Penajam" />
                
                <flux:select wire:model="form.radius" label="Radius">
                    <flux:select.option value="">Pilih Radius</flux:select.option>
                    <flux:select.option value="Radius I">Radius I</flux:select.option>
                    <flux:select.option value="Radius II">Radius II</flux:select.option>
                    <flux:select.option value="Radius III">Radius III</flux:select.option>
                    <flux:select.option value="Radius IV">Radius IV</flux:select.option>
                    <flux:select.option value="Radius Khusus">Radius Khusus</flux:select.option>
                </flux:select>

                <flux:input type="number" wire:model="form.fee" label="Biaya (Rp)" />

                <flux:textarea wire:model="form.description" label="Keterangan" rows="3" />

                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary" class="flex-grow">{{ $isEditing ? 'Perbarui' : 'Simpan' }}</flux:button>
                    @if($isEditing)
                        <flux:button wire:click="resetForm" variant="subtle">Batal</flux:button>
                    @endif
                </div>
            </form>
        </flux:card>
    </div>

    <!-- Table Section -->
    <div class="lg:col-span-2">
        <flux:card class="p-0 overflow-hidden">
            <div class="p-6 border-b border-zinc-200 dark:border-zinc-700">
                <flux:heading size="lg">Daftar Biaya Radius</flux:heading>
            </div>

            <flux:table>
                <flux:table.columns>
                    <flux:table.column>Wilayah</flux:table.column>
                    <flux:table.column>Radius</flux:table.column>
                    <flux:table.column>Biaya</flux:table.column>
                    <flux:table.column></flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach($fees as $item)
                        <flux:table.row wire:key="{{ $item->id }}">
                            <flux:table.cell class="font-medium">{{ $item->region }}</flux:table.cell>
                            <flux:table.cell>{{ $item->radius }}</flux:table.cell>
                            <flux:table.cell>Rp {{ number_format($item->fee, 0, ',', '.') }}</flux:table.cell>
                            <flux:table.cell>
                                <div class="flex gap-2 justify-end">
                                    <flux:button wire:click="edit({{ $item->id }})" size="sm" icon="pencil-square" variant="ghost" />
                                    <flux:button wire:click="delete({{ $item->id }})" size="sm" icon="trash" variant="ghost" class="text-red-600" wire:confirm="Hapus data ini?" />
                                </div>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>

            <div class="p-4">
                {{ $fees->links() }}
            </div>
        </flux:card>
    </div>
</div>

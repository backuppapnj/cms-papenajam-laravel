<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6">
        <flux:heading size="xl">Edit Prosedur</flux:heading>
        <flux:subheading>Perbarui panduan alur perkara.</flux:subheading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="form.title" label="Judul Prosedur" placeholder="Masukkan judul..." />

        <div class="space-y-2">
            <flux:label>Infografis (Gambar)</flux:label>
            @if($procedure->getFirstMediaUrl('infographics'))
                <img src="{{ $procedure->getFirstMediaUrl('infographics') }}" alt="Infografis" class="w-full max-h-64 object-contain rounded-lg mb-2 border border-zinc-200 shadow-sm">
            @endif
            <flux:input type="file" wire:model="form.infographic" />
        </div>

        <flux:textarea wire:model="form.content" label="Panduan Teks" placeholder="Tuliskan langkah-langkah detail di sini..." rows="15" />

        <div class="flex justify-end gap-2">
            <flux:button href="{{ route('admin.procedures.index') }}" variant="subtle">Batal</flux:button>
            <flux:button type="submit" variant="primary">Simpan Perubahan</flux:button>
        </div>
    </form>
</div>

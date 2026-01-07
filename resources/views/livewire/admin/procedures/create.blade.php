<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6">
        <flux:heading size="xl">Tambah Prosedur Baru</flux:heading>
        <flux:subheading>Masukkan panduan teks atau unggah infografis.</flux:subheading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="form.title" label="Judul Prosedur" placeholder="Misal: Prosedur Cerai Gugat" />

        <div class="space-y-2">
            <flux:label>Infografis (Gambar)</flux:label>
            <flux:input type="file" wire:model="form.infographic" />
        </div>

        <flux:textarea wire:model="form.content" label="Panduan Teks" placeholder="Tuliskan langkah-langkah detail di sini..." rows="15" />

        <div class="flex justify-end gap-2">
            <flux:button href="{{ route('admin.procedures.index') }}" variant="subtle">Batal</flux:button>
            <flux:button type="submit" variant="primary">Simpan Prosedur</flux:button>
        </div>
    </form>
</div>

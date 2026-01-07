<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6">
        <flux:heading size="xl">Manajemen {{ $key === 'visi_misi' ? 'Visi & Misi' : 'Sejarah' }}</flux:heading>
        <flux:subheading>Atur konten halaman statis profil instansi.</flux:subheading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="title" label="Judul Halaman" placeholder="Masukkan judul..." />

        <flux:textarea wire:model="content" label="Konten" placeholder="Masukkan konten detail..." rows="15" />

        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">Simpan Konten</flux:button>
        </div>
    </form>
</div>

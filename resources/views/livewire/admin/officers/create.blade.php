<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6">
        <flux:heading size="xl">Tambah Pejabat Baru</flux:heading>
        <flux:subheading>Lengkapi data personel untuk struktur organisasi.</flux:subheading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="form.name" label="Nama Lengkap" placeholder="Masukkan nama..." />
        
        <flux:input wire:model="form.position" label="Jabatan" placeholder="Masukkan jabatan..." />

        <div class="grid grid-cols-2 gap-4">
            <flux:input type="number" wire:model="form.level" label="Level Hierarki" description="1 untuk Ketua, 2 untuk Wakil, dst." />
            <flux:input type="number" wire:model="form.order" label="Urutan Tampilan" description="Urutan dalam satu level yang sama." />
        </div>

        <div class="space-y-2">
            <flux:label>Foto Profil</flux:label>
            <flux:input type="file" wire:model="form.photo" />
        </div>

        <div class="flex justify-end gap-2">
            <flux:button href="{{ route('admin.officers.index') }}" variant="subtle">Batal</flux:button>
            <flux:button type="submit" variant="primary">Simpan Pejabat</flux:button>
        </div>
    </form>
</div>

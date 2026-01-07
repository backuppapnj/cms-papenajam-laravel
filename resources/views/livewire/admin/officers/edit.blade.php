<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6">
        <flux:heading size="xl">Edit Data Pejabat</flux:heading>
        <flux:subheading>Perbarui informasi personel instansi.</flux:subheading>
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
            @if($officer->getFirstMediaUrl('officers'))
                <img src="{{ $officer->getFirstMediaUrl('officers') }}" alt="{{ $officer->name }}" class="w-32 h-32 rounded-lg object-cover mb-2 border border-zinc-200 shadow-sm">
            @endif
            <flux:input type="file" wire:model="form.photo" />
        </div>

        <div class="flex justify-end gap-2">
            <flux:button href="{{ route('admin.officers.index') }}" variant="subtle">Batal</flux:button>
            <flux:button type="submit" variant="primary">Simpan Perubahan</flux:button>
        </div>
    </form>
</div>

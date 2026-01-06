<div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="xl">Edit Berita</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="form.title" label="Judul Berita" placeholder="Masukkan judul berita..." />
        
        <div class="space-y-2">
            <flux:label>Gambar Utama</flux:label>
            @if($news->getFirstMediaUrl('images'))
                <img src="{{ $news->getFirstMediaUrl('images') }}" alt="Current Image" class="h-32 w-auto object-cover rounded-md border border-zinc-200 dark:border-zinc-700 mb-2">
            @endif
            <flux:input type="file" wire:model="form.image" />
        </div>

        <flux:textarea wire:model="form.content" label="Konten Berita" placeholder="Tulis konten berita di sini..." rows="10" />

        <flux:checkbox wire:model="form.is_published" label="Publikasikan Berita Ini" description="Berita akan langsung tampil di website jika opsi ini dicentang." />

        <div class="flex justify-end gap-2">
            <flux:button href="{{ route('admin.news.index') }}" variant="subtle">Batal</flux:button>
            <flux:button type="submit" variant="primary">Simpan Perubahan</flux:button>
        </div>
    </form>
</div>
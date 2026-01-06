<div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="xl">Upload Dokumen</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="form.title" label="Judul Dokumen" placeholder="Nama dokumen..." />

        <flux:input wire:model="form.category" label="Kategori" placeholder="Misal: Laporan, Regulasi, Formulir" />

        <flux:input type="file" wire:model="form.file" label="File Dokumen" description="PDF, DOCX, XLSX. Max 20MB." />

        <flux:textarea wire:model="form.description" label="Keterangan" placeholder="Keterangan tambahan..." />

        <flux:checkbox wire:model="form.is_published" label="Publikasikan" />

        <div class="flex justify-end gap-2">
            <flux:button href="{{ route('admin.documents.index') }}" variant="subtle">Batal</flux:button>
            <flux:button type="submit" variant="primary">Simpan</flux:button>
        </div>
    </form>
</div>
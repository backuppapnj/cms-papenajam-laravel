<?php

use App\Models\Document;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

new class extends Component {
    use WithFileUploads;

    public array $form = [
        'title' => '',
        'category' => '',
        'description' => '',
        'is_published' => true,
        'file' => null,
    ];

    public function save()
    {
        $this->validate([
            'form.title' => 'required|min:3',
            'form.file' => 'required|file|max:20480', // 20MB
            'form.is_published' => 'boolean',
        ]);

        $document = Document::create([
            'title' => $this->form['title'],
            'slug' => Str::slug($this->form['title']) . '-' . Str::random(5),
            'category' => $this->form['category'],
            'description' => $this->form['description'],
            'is_published' => $this->form['is_published'],
            'published_at' => $this->form['is_published'] ? now() : null,
        ]);

        if ($this->form['file']) {
            $document->addMedia($this->form['file'])->toMediaCollection('documents');
        }

        $this->js("Flux.toast('Dokumen berhasil diunggah.')");

        return redirect()->route('admin.documents.index');
    }
}; ?>

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

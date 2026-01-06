<?php

use App\Models\Gallery;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

new class extends Component {
    use WithFileUploads;

    public array $form = [
        'title' => '',
        'description' => '',
        'type' => 'image',
        'is_published' => true,
        'file' => null,
    ];

    public function save()
    {
        $this->validate([
            'form.title' => 'required|min:3',
            'form.type' => 'required|in:image,video',
            'form.file' => 'required|file|max:50120', // 50MB max
            'form.is_published' => 'boolean',
        ]);

        $gallery = Gallery::create([
            'title' => $this->form['title'],
            'slug' => Str::slug($this->form['title']) . '-' . Str::random(5),
            'description' => $this->form['description'],
            'type' => $this->form['type'],
            'is_published' => $this->form['is_published'],
            'published_at' => $this->form['is_published'] ? now() : null,
        ]);

        if ($this->form['file']) {
            $gallery->addMedia($this->form['file'])->toMediaCollection('gallery');
        }

        $this->js("Flux.toast('Item galeri berhasil ditambahkan.')");

        return redirect()->route('admin.gallery.index');
    }
}; ?>

<div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="xl">Tambah Galeri</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="form.title" label="Judul" placeholder="Judul foto atau video..." />

        <flux:select wire:model="form.type" label="Tipe Media">
            <flux:select.option value="image">Foto</flux:select.option>
            <flux:select.option value="video">Video</flux:select.option>
        </flux:select>

        <flux:input type="file" wire:model="form.file" label="Upload File" description="Format: JPG, PNG, MP4. Max 50MB." />

        <flux:textarea wire:model="form.description" label="Deskripsi" placeholder="Deskripsi singkat..." />

        <flux:checkbox wire:model="form.is_published" label="Publikasikan" />

        <div class="flex justify-end gap-2">
            <flux:button href="{{ route('admin.gallery.index') }}" variant="subtle">Batal</flux:button>
            <flux:button type="submit" variant="primary">Simpan</flux:button>
        </div>
    </form>
</div>

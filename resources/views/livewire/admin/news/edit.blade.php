<?php

use App\Models\News;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

new class extends Component {
    use WithFileUploads;

    public News $news;
    public array $form = [];

    public function mount(News $news)
    {
        $this->news = $news;
        $this->form = [
            'title' => $news->title,
            'content' => $news->content,
            'is_published' => (bool) $news->is_published,
            'image' => null,
        ];
    }

    public function save()
    {
        $this->validate([
            'form.title' => 'required|min:3',
            'form.content' => 'required',
            'form.is_published' => 'boolean',
            'form.image' => 'nullable|image|max:2048',
        ]);

        $this->news->update([
            'title' => $this->form['title'],
            // Slug usually doesn't change on edit to preserve SEO links, but can be optional
            'content' => $this->form['content'],
            'is_published' => $this->form['is_published'],
            'published_at' => ($this->form['is_published'] && !$this->news->published_at) ? now() : $this->news->published_at,
        ]);

        if ($this->form['image']) {
            $this->news->clearMediaCollection('images');
            $this->news->addMedia($this->form['image'])->toMediaCollection('images');
        }

        $this->js("Flux.toast('Berita berhasil diperbarui.')");

        return redirect()->route('admin.news.index');
    }
}; ?>

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


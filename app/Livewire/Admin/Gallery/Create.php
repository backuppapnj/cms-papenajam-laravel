<?php

namespace App\Livewire\Admin\Gallery;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
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

    public function render()
    {
        return view('livewire.admin.gallery.create');
    }
}

<?php

namespace App\Livewire\Admin\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public array $form = [
        'title' => '',
        'content' => '',
        'is_published' => false,
        'image' => null,
    ];

    public function save()
    {
        $this->validate([
            'form.title' => 'required|min:3',
            'form.content' => 'required',
            'form.is_published' => 'boolean',
            'form.image' => 'nullable|image|max:2048',
        ]);

        $news = News::create([
            'title' => $this->form['title'],
            'slug' => Str::slug($this->form['title']) . '-' . Str::random(5),
            'content' => $this->form['content'],
            'is_published' => $this->form['is_published'],
            'published_at' => $this->form['is_published'] ? now() : null,
        ]);

        if ($this->form['image']) {
            $news->addMedia($this->form['image'])->toMediaCollection('images');
        }

        $this->js("Flux.toast('Berita berhasil dibuat.')");

        return redirect()->route('admin.news.index');
    }

    public function render()
    {
        return view('livewire.admin.news.create');
    }
}

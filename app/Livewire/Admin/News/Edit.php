<?php

namespace App\Livewire\Admin\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
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

    public function render()
    {
        return view('livewire.admin.news.edit');
    }
}

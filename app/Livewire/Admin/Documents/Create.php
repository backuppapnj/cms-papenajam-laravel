<?php

namespace App\Livewire\Admin\Documents;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
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

    public function render()
    {
        return view('livewire.admin.documents.create');
    }
}

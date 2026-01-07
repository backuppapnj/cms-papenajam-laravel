<?php

namespace App\Livewire\Admin\Procedures;

use App\Models\Procedure;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public array $form = [
        'title' => '',
        'content' => '',
        'infographic' => null,
    ];

    public function save()
    {
        $this->validate([
            'form.title' => 'required|min:3',
            'form.content' => 'nullable',
            'form.infographic' => 'nullable|image|max:2048',
        ]);

        $procedure = Procedure::create([
            'title' => $this->form['title'],
            'slug' => Str::slug($this->form['title']) . '-' . Str::random(5),
            'content' => $this->form['content'],
        ]);

        if ($this->form['infographic']) {
            $procedure->addMedia($this->form['infographic'])->toMediaCollection('infographics');
        }

        $this->js("Flux.toast('Prosedur berhasil ditambahkan.')");

        return redirect()->route('admin.procedures.index');
    }

    public function render()
    {
        return view('livewire.admin.procedures.create');
    }
}

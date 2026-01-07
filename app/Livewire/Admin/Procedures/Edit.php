<?php

namespace App\Livewire\Admin\Procedures;

use App\Models\Procedure;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Procedure $procedure;
    public array $form = [];

    public function mount(Procedure $procedure)
    {
        $this->procedure = $procedure;
        $this->form = [
            'title' => $procedure->title,
            'content' => $procedure->content,
            'infographic' => null,
        ];
    }

    public function save()
    {
        $this->validate([
            'form.title' => 'required|min:3',
            'form.content' => 'nullable',
            'form.infographic' => 'nullable|image|max:2048',
        ]);

        $this->procedure->update([
            'title' => $this->form['title'],
            'content' => $this->form['content'],
        ]);

        if ($this->form['infographic']) {
            $this->procedure->clearMediaCollection('infographics');
            $this->procedure->addMedia($this->form['infographic'])->toMediaCollection('infographics');
        }

        $this->js("Flux.toast('Prosedur berhasil diperbarui.')");

        return redirect()->route('admin.procedures.index');
    }

    public function render()
    {
        return view('livewire.admin.procedures.edit');
    }
}

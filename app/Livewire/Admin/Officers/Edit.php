<?php

namespace App\Livewire\Admin\Officers;

use App\Models\Officer;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Officer $officer;
    public array $form = [];

    public function mount(Officer $officer)
    {
        $this->officer = $officer;
        $this->form = [
            'name' => $officer->name,
            'position' => $officer->position,
            'order' => $officer->order,
            'level' => $officer->level,
            'photo' => null,
        ];
    }

    public function save()
    {
        $this->validate([
            'form.name' => 'required|min:3',
            'form.position' => 'required',
            'form.order' => 'required|integer',
            'form.level' => 'required|integer',
            'form.photo' => 'nullable|image|max:2048',
        ]);

        $this->officer->update([
            'name' => $this->form['name'],
            'position' => $this->form['position'],
            'order' => $this->form['order'],
            'level' => $this->form['level'],
        ]);

        if ($this->form['photo']) {
            $this->officer->clearMediaCollection('officers');
            $this->officer->addMedia($this->form['photo'])->toMediaCollection('officers');
        }

        $this->js("Flux.toast('Pejabat berhasil diperbarui.')");

        return redirect()->route('admin.officers.index');
    }

    public function render()
    {
        return view('livewire.admin.officers.edit');
    }
}

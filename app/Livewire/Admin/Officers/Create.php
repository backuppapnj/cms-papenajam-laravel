<?php

namespace App\Livewire\Admin\Officers;

use App\Models\Officer;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public array $form = [
        'name' => '',
        'position' => '',
        'order' => 0,
        'level' => 1,
        'photo' => null,
    ];

    public function save()
    {
        $this->validate([
            'form.name' => 'required|min:3',
            'form.position' => 'required',
            'form.order' => 'required|integer',
            'form.level' => 'required|integer',
            'form.photo' => 'nullable|image|max:2048',
        ]);

        $officer = Officer::create([
            'name' => $this->form['name'],
            'position' => $this->form['position'],
            'order' => $this->form['order'],
            'level' => $this->form['level'],
        ]);

        if ($this->form['photo']) {
            $officer->addMedia($this->form['photo'])->toMediaCollection('officers');
        }

        $this->js("Flux.toast('Pejabat berhasil ditambahkan.')");

        return redirect()->route('admin.officers.index');
    }

    public function render()
    {
        return view('livewire.admin.officers.create');
    }
}

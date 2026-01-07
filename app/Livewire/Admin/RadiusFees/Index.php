<?php

namespace App\Livewire\Admin\RadiusFees;

use App\Models\RadiusFee;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public array $form = [
        'id' => null,
        'region' => '',
        'radius' => '',
        'fee' => 0,
        'description' => '',
    ];

    public bool $isEditing = false;

    public function save()
    {
        $this->validate([
            'form.region' => 'required',
            'form.radius' => 'required',
            'form.fee' => 'required|numeric',
            'form.description' => 'nullable',
        ]);

        if ($this->form['id']) {
            RadiusFee::find($this->form['id'])->update($this->form);
            $this->js("Flux.toast('Biaya radius berhasil diperbarui.')");
        } else {
            RadiusFee::create($this->form);
            $this->js("Flux.toast('Biaya radius berhasil ditambahkan.')");
        }

        $this->resetForm();
    }

    public function edit(RadiusFee $radiusFee)
    {
        $this->form = $radiusFee->toArray();
        $this->isEditing = true;
    }

    public function delete(RadiusFee $radiusFee)
    {
        $radiusFee->delete();
        $this->js("Flux.toast('Biaya radius berhasil dihapus.')");
    }

    public function resetForm()
    {
        $this->reset('form', 'isEditing');
    }

    public function render()
    {
        return view('livewire.admin.radius-fees.index', [
            'fees' => RadiusFee::latest()->paginate(15),
        ]);
    }
}

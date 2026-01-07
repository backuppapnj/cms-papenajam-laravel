<?php

namespace App\Livewire\Admin\Procedures;

use App\Models\Procedure;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(Procedure $procedure)
    {
        $procedure->delete();
        $this->js("Flux.toast('Prosedur berhasil dihapus.')");
    }

    public function render()
    {
        return view('livewire.admin.procedures.index', [
            'procedures' => Procedure::latest()->paginate(10),
        ]);
    }
}

<?php

namespace App\Livewire\Admin\Officers;

use App\Models\Officer;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(Officer $officer)
    {
        $officer->delete();
        $this->js("Flux.toast('Pejabat berhasil dihapus.')");
    }

    public function render()
    {
        return view('livewire.admin.officers.index', [
            'officers' => Officer::orderBy('level')->orderBy('order')->paginate(10),
        ]);
    }
}

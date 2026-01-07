<?php

namespace App\Livewire\Public\Services;

use App\Models\Procedure as ProcedureModel;
use Livewire\Component;

class Procedure extends Component
{
    public ProcedureModel $procedure;

    public function mount($slug)
    {
        $this->procedure = ProcedureModel::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.services.procedure')
            ->layout('components.layouts.public');
    }
}

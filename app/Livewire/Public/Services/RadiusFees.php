<?php

namespace App\Livewire\Public\Services;

use App\Models\RadiusFee;
use Livewire\Component;
use Livewire\WithPagination;

class RadiusFees extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $fees = RadiusFee::when($this->search, function ($query) {
                $query->where('region', 'like', '%' . $this->search . '%');
            })
            ->orderBy('radius')
            ->orderBy('region')
            ->paginate(20);

        return view('livewire.public.services.radius-fees', [
            'fees' => $fees,
        ])->layout('components.layouts.public');
    }
}

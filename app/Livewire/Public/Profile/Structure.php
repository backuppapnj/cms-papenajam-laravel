<?php

namespace App\Livewire\Public\Profile;

use App\Models\Officer;
use Livewire\Component;

class Structure extends Component
{
    public function render()
    {
        $officers = Officer::orderBy('level')->orderBy('order')->get();

        return view('livewire.public.profile.structure', [
            'officers' => $officers,
        ])->layout('components.layouts.public');
    }
}

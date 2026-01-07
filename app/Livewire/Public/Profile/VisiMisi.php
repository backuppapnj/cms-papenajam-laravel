<?php

namespace App\Livewire\Public\Profile;

use App\Models\ProfileContent;
use Livewire\Component;

class VisiMisi extends Component
{
    public function render()
    {
        $content = ProfileContent::where('key', 'visi_misi')->first();

        return view('livewire.public.profile.visi-misi', [
            'content' => $content,
        ])->layout('components.layouts.public');
    }
}

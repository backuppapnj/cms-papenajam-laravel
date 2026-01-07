<?php

namespace App\Livewire\Public\Profile;

use App\Models\ProfileContent;
use Livewire\Component;

class Sejarah extends Component
{
    public function render()
    {
        $content = ProfileContent::where('key', 'sejarah')->first();

        return view('livewire.public.profile.sejarah', [
            'content' => $content,
        ])->layout('components.layouts.public');
    }
}

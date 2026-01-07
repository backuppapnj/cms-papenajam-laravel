<?php

namespace App\Livewire\Public\Gallery;

use App\Models\Gallery;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public $type = '';

    public function updatingType()
    {
        $this->resetPage();
    }

    public function render()
    {
        $galleries = Gallery::where('is_published', true)
            ->when($this->type, function ($query) {
                $query->where('type', $this->type);
            })
            ->latest()
            ->paginate(16);

        return view('livewire.public.gallery.index', [
            'galleries' => $galleries,
        ])->layout('components.layouts.public');
    }
}

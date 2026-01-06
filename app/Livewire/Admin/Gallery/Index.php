<?php

namespace App\Livewire\Admin\Gallery;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(Gallery $gallery)
    {
        $gallery->delete();
        $this->js("Flux.toast('Item galeri berhasil dihapus.')");
    }

    public function render()
    {
        return view('livewire.admin.gallery.index', [
            'galleries' => Gallery::latest()->paginate(12),
        ]);
    }
}

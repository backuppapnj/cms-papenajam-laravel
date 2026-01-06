<?php

namespace App\Livewire\Admin\Documents;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(Document $document)
    {
        $document->delete();
        $this->js("Flux.toast('Dokumen berhasil dihapus.')");
    }

    public function render()
    {
        return view('livewire.admin.documents.index', [
            'documents' => Document::latest()->paginate(10),
        ]);
    }
}

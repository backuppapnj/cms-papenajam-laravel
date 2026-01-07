<?php

namespace App\Livewire\Public\Documents;

use App\Models\Document;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function download(Document $document)
    {
        $document->increment('download_count');

        $media = $document->getFirstMedia('documents');

        if ($media) {
            return response()->download($media->getPath(), $media->file_name);
        }

        $this->js("Flux.toast('Gagal mengunduh file.')");
    }

    public function render()
    {
        $documents = Document::where('is_published', true)
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('category', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate(15);

        return view('livewire.public.documents.index', [
            'documents' => $documents,
        ])->layout('components.layouts.public');
    }
}

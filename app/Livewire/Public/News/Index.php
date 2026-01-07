<?php

namespace App\Livewire\Public\News;

use App\Models\News;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    #[Url]
    public $category = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $news = News::where('is_published', true)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('content', 'like', '%'.$this->search.'%');
                });
            })
            ->latest()
            ->paginate(12);

        $popularNews = News::where('is_published', true)
            ->inRandomOrder() // Placeholder for popular
            ->take(5)
            ->get();

        return view('livewire.public.news.index', [
            'news' => $news,
            'popularNews' => $popularNews,
        ])->layout('components.layouts.public');
    }
}

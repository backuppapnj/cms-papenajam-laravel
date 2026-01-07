<?php

namespace App\Livewire\Public\News;

use App\Models\News;
use Livewire\Component;

class Show extends Component
{
    public News $news;

    public function mount($slug)
    {
        $this->news = News::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
    }

    public function render()
    {
        $recentNews = News::where('is_published', true)
            ->where('id', '!=', $this->news->id)
            ->latest()
            ->take(5)
            ->get();

        $previousNews = News::where('is_published', true)
            ->where('published_at', '<', $this->news->published_at)
            ->latest('published_at')
            ->first();

        $nextNews = News::where('is_published', true)
            ->where('published_at', '>', $this->news->published_at)
            ->oldest('published_at')
            ->first();

        return view('livewire.public.news.show', [
            'recentNews' => $recentNews,
            'previousNews' => $previousNews,
            'nextNews' => $nextNews,
        ])->layout('components.layouts.public');
    }
}

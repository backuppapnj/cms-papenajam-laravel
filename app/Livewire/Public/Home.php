<?php

namespace App\Livewire\Public;

use App\Models\News;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $latestNews = News::where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('livewire.public.home', [
            'latestNews' => $latestNews,
        ])->layout('components.layouts.public');
    }
}

<?php

namespace App\Livewire\Admin\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(News $news)
    {
        $news->delete();
        $this->js("Flux.toast('Berita berhasil dihapus.')");
    }

    public function render()
    {
        return view('livewire.admin.news.index', [
            'news' => News::latest()->paginate(10),
        ]);
    }
}

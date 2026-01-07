<?php

use App\Livewire\Public\News\Index as PublicNewsIndex;
use App\Models\News;
use Livewire\Livewire;

test('public news archive can be rendered', function () {
    News::factory()->create([
        'title' => 'Berita Arsip Test',
        'is_published' => true,
    ]);

    $this->get(route('public.news.index'))
        ->assertOk()
        ->assertSee('Berita Arsip Test');
});

test('public news detail can be rendered', function () {
    $news = News::factory()->create([
        'title' => 'Detail Berita Test',
        'content' => 'Isi konten berita yang sangat detail.',
        'is_published' => true,
    ]);

    $this->get(route('public.news.show', $news->slug))
        ->assertOk()
        ->assertSee('Detail Berita Test')
        ->assertSee('Isi konten berita yang sangat detail.')
        ->assertSee('Bagikan') // Share section
        ->assertSee('Cetak'); // Print button
});

test('unpublished news cannot be viewed', function () {
    $news = News::factory()->create([
        'is_published' => false,
    ]);

    $this->get(route('public.news.show', $news->slug))
        ->assertNotFound();
});

test('public news can be searched', function () {
    News::factory()->create(['title' => 'KeywordUnikBanget', 'is_published' => true]);
    News::factory()->create(['title' => 'Judul Biasa', 'is_published' => true]);

    Livewire::test(PublicNewsIndex::class)
        ->set('search', 'KeywordUnikBanget')
        ->assertViewHas('news', function ($news) {
            return $news->count() === 1 && $news->first()->title === 'KeywordUnikBanget';
        });
});

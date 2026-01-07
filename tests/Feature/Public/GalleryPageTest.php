<?php

use App\Livewire\Public\Gallery\Index as PublicGalleryIndex;
use App\Models\Gallery;
use Livewire\Livewire;

test('public gallery page can be rendered', function () {
    Gallery::factory()->create([
        'title' => 'Foto Kegiatan Test',
        'is_published' => true,
    ]);

    $this->get(route('public.gallery'))
        ->assertOk()
        ->assertSee('Foto Kegiatan Test');
});

test('public gallery can be filtered by type', function () {
    Gallery::factory()->create(['title' => 'Item Foto', 'type' => 'image', 'is_published' => true]);
    Gallery::factory()->create(['title' => 'Item Video', 'type' => 'video', 'is_published' => true]);

    Livewire::test(PublicGalleryIndex::class)
        ->set('type', 'image')
        ->assertSee('Item Foto')
        ->assertDontSee('Item Video')
        ->set('type', 'video')
        ->assertSee('Item Video')
        ->assertDontSee('Item Foto');
});

test('unpublished gallery items are not visible', function () {
    Gallery::factory()->create(['title' => 'Rahasia', 'is_published' => false]);

    $this->get(route('public.gallery'))
        ->assertDontSee('Rahasia');
});

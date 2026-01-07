<?php

use App\Livewire\Public\Documents\Index as PublicDocumentsIndex;
use App\Models\Document;
use Livewire\Livewire;

test('public document page can be rendered', function () {
    Document::factory()->create([
        'title' => 'Laporan Tahunan 2025',
        'is_published' => true,
    ]);

    $this->get(route('public.documents'))
        ->assertOk()
        ->assertSee('Laporan Tahunan 2025');
});

test('public documents can be searched', function () {
    Document::factory()->create(['title' => 'Dokumen Unik', 'is_published' => true]);
    Document::factory()->create(['title' => 'File Lain', 'is_published' => true]);

    Livewire::test(PublicDocumentsIndex::class)
        ->set('search', 'Unik')
        ->assertSee('Dokumen Unik')
        ->assertDontSee('File Lain');
});

test('unpublished documents are not visible', function () {
    Document::factory()->create(['title' => 'Draft Rahasia', 'is_published' => false]);

    $this->get(route('public.documents'))
        ->assertDontSee('Draft Rahasia');
});

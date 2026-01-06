<?php

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $this->user = User::factory()->create();
    $role = Role::firstOrCreate(['name' => 'super-admin']);
    $this->user->assignRole($role);
    Storage::fake('public');
});

test('admin can visit document index page', function () {
    $this->actingAs($this->user)
        ->get(route('admin.documents.index'))
        ->assertOk()
        ->assertSee('Dokumen');
});

test('admin can upload document', function () {
    $file = UploadedFile::fake()->create('report.pdf', 1000, 'application/pdf');

    Volt::test('admin.documents.create')
        ->set('form.title', 'Laporan Tahunan')
        ->set('form.category', 'Laporan')
        ->set('form.description', 'Deskripsi laporan')
        ->set('form.file', $file)
        ->set('form.is_published', true)
        ->call('save')
        ->assertRedirect(route('admin.documents.index'));

    $document = Document::where('title', 'Laporan Tahunan')->first();
    expect($document)->not->toBeNull();
    expect($document->getMedia('documents'))->not->toBeEmpty();
    expect($document->category)->toBe('Laporan');
});

test('title and file are required', function () {
    Volt::test('admin.documents.create')
        ->set('form.title', '')
        ->set('form.file', null)
        ->call('save')
        ->assertHasErrors(['form.title', 'form.file']);
});

test('admin can delete document', function () {
    $document = Document::factory()->create();

    Volt::test('admin.documents.index')
        ->call('delete', $document->id);

    $this->assertDatabaseMissing('documents', [
        'id' => $document->id,
    ]);
});

<?php

use App\Models\Gallery;
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

test('admin can visit gallery index page', function () {
    $this->actingAs($this->user)
        ->get(route('admin.gallery.index'))
        ->assertOk()
        ->assertSee('Galeri');
});

test('admin can create gallery item with image', function () {
    $file = UploadedFile::fake()->image('photo.jpg');

    Volt::test('admin.gallery.create')
        ->set('form.title', 'Foto Kegiatan')
        ->set('form.description', 'Deskripsi foto')
        ->set('form.type', 'image')
        ->set('form.file', $file)
        ->set('form.is_published', true)
        ->call('save')
        ->assertRedirect(route('admin.gallery.index'));

    $gallery = Gallery::where('title', 'Foto Kegiatan')->first();
    expect($gallery)->not->toBeNull();
    expect($gallery->getMedia('gallery'))->not->toBeEmpty();
    expect($gallery->type)->toBe('image');
});

test('admin can create gallery item with video', function () {
    $file = UploadedFile::fake()->create('video.mp4', 1000, 'video/mp4');

    Volt::test('admin.gallery.create')
        ->set('form.title', 'Video Kegiatan')
        ->set('form.description', 'Deskripsi video')
        ->set('form.type', 'video')
        ->set('form.file', $file)
        ->set('form.is_published', true)
        ->call('save')
        ->assertRedirect(route('admin.gallery.index'));

    $gallery = Gallery::where('title', 'Video Kegiatan')->first();
    expect($gallery)->not->toBeNull();
    expect($gallery->getMedia('gallery'))->not->toBeEmpty();
    expect($gallery->type)->toBe('video');
});

test('title and file are required', function () {
    Volt::test('admin.gallery.create')
        ->set('form.title', '')
        ->set('form.file', null)
        ->call('save')
        ->assertHasErrors(['form.title', 'form.file']);
});

test('admin can delete gallery item', function () {
    $gallery = Gallery::factory()->create();

    Volt::test('admin.gallery.index')
        ->call('delete', $gallery->id);

    $this->assertDatabaseMissing('galleries', [
        'id' => $gallery->id,
    ]);
});

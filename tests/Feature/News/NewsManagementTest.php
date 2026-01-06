<?php

use App\Models\News;
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

test('admin can create news with image', function () {
    $file = UploadedFile::fake()->image('news.jpg');

    Volt::test('admin.news.create')
        ->set('form.title', 'Berita dengan Gambar')
        ->set('form.content', 'Konten...')
        ->set('form.image', $file)
        ->call('save')
        ->assertRedirect(route('admin.news.index'));

    $news = News::where('title', 'Berita dengan Gambar')->first();
    expect($news->getMedia('images'))->not->toBeEmpty();
});


test('admin can visit news index page', function () {
    $this->actingAs($this->user)
        ->get(route('admin.news.index'))
        ->assertOk()
        ->assertSee('Berita');
});

test('admin can create news', function () {
    Volt::test('admin.news.create')
        ->set('form.title', 'Judul Berita Baru')
        ->set('form.content', 'Konten berita yang sangat menarik.')
        ->set('form.is_published', true)
        ->call('save')
        ->assertRedirect(route('admin.news.index'));

    $this->assertDatabaseHas('news', [
        'title' => 'Judul Berita Baru',
        'is_published' => true,
    ]);
});

test('title is required', function () {
    Volt::test('admin.news.create')
        ->set('form.title', '')
        ->call('save')
        ->assertHasErrors(['form.title']);
});

test('admin can edit news', function () {
    $news = News::factory()->create();

    Volt::test('admin.news.edit', ['news' => $news])
        ->set('form.title', 'Judul Diedit')
        ->call('save')
        ->assertRedirect(route('admin.news.index'));

    $this->assertDatabaseHas('news', [
        'id' => $news->id,
        'title' => 'Judul Diedit',
    ]);
});

test('admin can delete news', function () {
    $news = News::factory()->create();

    Volt::test('admin.news.index')
        ->call('delete', $news->id);

    $this->assertDatabaseMissing('news', [
        'id' => $news->id,
    ]);
});

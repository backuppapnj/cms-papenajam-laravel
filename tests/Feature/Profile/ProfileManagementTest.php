<?php

use App\Models\ProfileContent;
use App\Models\User;
use App\Livewire\Admin\Profile\ProfileForm;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $this->user = User::factory()->create();
    $role = Role::firstOrCreate(['name' => 'super-admin']);
    $this->user->assignRole($role);
});

test('admin can save visi misi', function () {
    Livewire::actingAs($this->user)
        ->test(ProfileForm::class, ['key' => 'visi_misi'])
        ->set('title', 'Visi & Misi PA Penajam')
        ->set('content', 'Menjadi pengadilan yang agung.')
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('profile_contents', [
        'key' => 'visi_misi',
        'title' => 'Visi & Misi PA Penajam',
        'content' => 'Menjadi pengadilan yang agung.',
    ]);
});

test('admin can save sejarah', function () {
    Livewire::actingAs($this->user)
        ->test(ProfileForm::class, ['key' => 'sejarah'])
        ->set('title', 'Sejarah PA Penajam')
        ->set('content', 'Berdiri sejak tahun...')
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('profile_contents', [
        'key' => 'sejarah',
        'title' => 'Sejarah PA Penajam',
        'content' => 'Berdiri sejak tahun...',
    ]);
});

test('public can view visi misi', function () {
    ProfileContent::create([
        'key' => 'visi_misi',
        'title' => 'Visi Misi Kami',
        'content' => 'Konten visi misi.',
    ]);

    $this->get(route('public.profile.visi-misi'))
        ->assertOk()
        ->assertSee('Visi Misi Kami')
        ->assertSee('Konten visi misi.');
});

test('public can view sejarah', function () {
    ProfileContent::create([
        'key' => 'sejarah',
        'title' => 'Sejarah Kami',
        'content' => 'Konten sejarah.',
    ]);

    $this->get(route('public.profile.sejarah'))
        ->assertOk()
        ->assertSee('Sejarah Kami')
        ->assertSee('Konten sejarah.');
});

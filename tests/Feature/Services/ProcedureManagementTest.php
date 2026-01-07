<?php

use App\Models\Procedure;
use App\Models\User;
use App\Livewire\Admin\Procedures\Index as ProcedureIndex;
use App\Livewire\Admin\Procedures\Create as ProcedureCreate;
use App\Livewire\Admin\Procedures\Edit as ProcedureEdit;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $this->user = User::factory()->create();
    $role = Role::firstOrCreate(['name' => 'super-admin']);
    $this->user->assignRole($role);
    Storage::fake('public');
});

test('admin can list procedures', function () {
    Procedure::create(['title' => 'Cerai Gugat', 'slug' => 'cerai-gugat']);

    Livewire::actingAs($this->user)
        ->test(ProcedureIndex::class)
        ->assertSee('Cerai Gugat');
});

test('admin can create procedure with infographic', function () {
    $file = UploadedFile::fake()->image('infografis.jpg');

    Livewire::actingAs($this->user)
        ->test(ProcedureCreate::class)
        ->set('form.title', 'Izin Poligami')
        ->set('form.content', 'Langkah-langkah poligami...')
        ->set('form.infographic', $file)
        ->call('save')
        ->assertRedirect(route('admin.procedures.index'));

    $procedure = Procedure::where('title', 'Izin Poligami')->first();
    expect($procedure->getFirstMediaUrl('infographics'))->not->toBeEmpty();
});

test('admin can update procedure', function () {
    $procedure = Procedure::create(['title' => 'Lama', 'slug' => 'lama']);

    Livewire::actingAs($this->user)
        ->test(ProcedureEdit::class, ['procedure' => $procedure])
        ->set('form.title', 'Baru')
        ->call('save');

    expect($procedure->fresh()->title)->toBe('Baru');
});

test('public can view procedure', function () {
    $procedure = Procedure::create([
        'title' => 'Prosedur Pendaftaran',
        'slug' => 'prosedur-pendaftaran',
        'content' => 'Isi prosedur.'
    ]);

    $this->get(route('public.services.procedure', $procedure->slug))
        ->assertOk()
        ->assertSee('Prosedur Pendaftaran');
});

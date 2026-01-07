<?php

use App\Models\Officer;
use App\Models\User;
use App\Livewire\Admin\Officers\Index as OfficerIndex;
use App\Livewire\Admin\Officers\Create as OfficerCreate;
use App\Livewire\Admin\Officers\Edit as OfficerEdit;
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

test('admin can list officers', function () {
    Officer::factory()->count(3)->create();

    Livewire::actingAs($this->user)
        ->test(OfficerIndex::class)
        ->assertViewHas('officers', function ($officers) {
            return $officers->count() === 3;
        });
});

test('admin can create officer with photo', function () {
    $file = UploadedFile::fake()->image('officer.jpg');

    Livewire::actingAs($this->user)
        ->test(OfficerCreate::class)
        ->set('form.name', 'John Doe')
        ->set('form.position', 'Ketua')
        ->set('form.order', 1)
        ->set('form.level', 1)
        ->set('form.photo', $file)
        ->call('save')
        ->assertRedirect(route('admin.officers.index'));

    $officer = Officer::where('name', 'John Doe')->first();
    expect($officer)->not->toBeNull();
    expect($officer->getFirstMediaUrl('officers'))->not->toBeEmpty();
});

test('admin can update officer', function () {
    $officer = Officer::factory()->create(['name' => 'Old Name']);

    Livewire::actingAs($this->user)
        ->test(OfficerEdit::class, ['officer' => $officer])
        ->set('form.name', 'New Name')
        ->call('save')
        ->assertRedirect(route('admin.officers.index'));

    expect($officer->fresh()->name)->toBe('New Name');
});

test('admin can delete officer', function () {
    $officer = Officer::factory()->create();

    Livewire::actingAs($this->user)
        ->test(OfficerIndex::class)
        ->call('delete', $officer->id);

    $this->assertDatabaseMissing('officers', ['id' => $officer->id]);
});

test('public can view organizational structure', function () {
    Officer::factory()->create([
        'name' => 'Ketua Hebat',
        'position' => 'Ketua',
        'level' => 1,
    ]);

    $this->get(route('public.profile.structure'))
        ->assertOk()
        ->assertSee('Ketua Hebat')
        ->assertSee('Ketua');
});

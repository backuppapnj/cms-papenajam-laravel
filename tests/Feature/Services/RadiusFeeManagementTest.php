<?php

use App\Models\RadiusFee;
use App\Models\User;
use App\Livewire\Admin\RadiusFees\Index as RadiusFeeIndex;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $this->user = User::factory()->create();
    $role = Role::firstOrCreate(['name' => 'super-admin']);
    $this->user->assignRole($role);
});

test('admin can manage radius fees', function () {
    Livewire::actingAs($this->user)
        ->test(RadiusFeeIndex::class)
        ->set('form.region', 'Penajam')
        ->set('form.radius', 'Radius I')
        ->set('form.fee', 100000)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('radius_fees', ['region' => 'Penajam', 'fee' => 100000]);
});

test('public can view radius fees table', function () {
    RadiusFee::create(['region' => 'Waru', 'radius' => 'Radius II', 'fee' => 150000]);

    $this->get(route('public.services.radius-fees'))
        ->assertOk()
        ->assertSee('Waru')
        ->assertSee('150.000');
});

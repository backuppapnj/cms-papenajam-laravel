<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'manage news',
            'manage gallery',
            'manage documents',
            'manage users',
            'access dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign existing permissions
        $adminRole = Role::create(['name' => 'super-admin']);
        // super-admin gets all permissions via Gate::before in AuthServiceProvider or similar
        // but for now let's assign explicitly
        $adminRole->givePermissionTo(Permission::all());

        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo(['manage news', 'manage gallery', 'manage documents', 'access dashboard']);

        // Create a default admin user
        $admin = User::factory()->withoutTwoFactor()->create([
            'name' => 'Admin CMS',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole($adminRole);

        $this->command->info('Default Admin created: admin@admin.com / password');
    }
}

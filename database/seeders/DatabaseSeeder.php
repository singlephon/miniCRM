<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Database\Factories\TicketFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * @throws BindingResolutionException
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@minicrm.com',
            'password' => bcrypt('password'),
        ]);

        $manager = User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@minicrm.com',
            'password' => bcrypt('password'),
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);

        $permissions = [
            'dashboard::view',
            'dashboard::edit',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $managerRole->syncPermissions($permissions);

        $admin->assignRole($adminRole);
        $manager->assignRole($managerRole);

        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        Customer::factory(3)->create();
        TicketFactory::times(5)->create();
    }
}

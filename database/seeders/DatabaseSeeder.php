<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Menu;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === PERMISSIONS ===
        $permissions = [
            'manage_users',
            'manage_roles',
            'manage_permissions',
            'manage_menus',
        ];
        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // === ROLES ===
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $managerRole->syncPermissions(['manage_users']); // hanya bisa kelola user

        // === USER DEFAULT ===
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Administrator', 'password' => bcrypt('password')]
        );
        $admin->assignRole($adminRole);

        $manager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            ['name' => 'Manager', 'password' => bcrypt('password')]
        );
        $manager->assignRole($managerRole);

        // === MENUS ===
        $menus = [
            ['name' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'house', 'order' => 1],
            ['name' => 'User Management', 'route' => 'users.index', 'icon' => 'people', 'order' => 2],
            ['name' => 'Roles', 'route' => 'roles.index', 'icon' => 'key', 'order' => 3],
            ['name' => 'Permissions', 'route' => 'permissions.index', 'icon' => 'lock', 'order' => 4],
            ['name' => 'Menus', 'route' => 'menus.index', 'icon' => 'list', 'order' => 5],
        ];

        foreach ($menus as $m) {
            Menu::firstOrCreate(['name' => $m['name']], $m);
        }

        $this->command->info('✅ Database seeding completed:');
        $this->command->info('  - Admin login: admin@example.com / password');
        $this->command->info('  - Manager login: manager@example.com / password');
    }
}

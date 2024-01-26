<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'mag-list',
            'mag-create',
            'mag-edit',
            'mag-delete',

            'page-list',
            'page-create',
            'page-edit',
            'page-delete',

            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            'tag-list',
            'tag-create',
            'tag-edit',
            'tag-delete',

            'widget-list',
            'widget-create',
            'widget-edit',
            'widget-delete',

            'faq-list',
            'faq-create',
            'faq-edit',
            'faq-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'gallery-list',
            'gallery-create',
            'gallery-edit',
            'gallery-delete',

            'settings-list',
            'settings-create',
            'settings-edit',
            'settings-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'phone' => '09190622401',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'manager' => 0,
            'admin' => 1,
            'ip_address' => request()->ip(),
            'client_ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
            'created_at' => now()->ceilDay(6)
        ]);
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        User::create([
            'name' => 'Manager',
            'username' => 'manager',
            'phone' => '09123456789',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('123456'),
            'manager' => 1,
            'admin' => 0,
            'ip_address' => request()->ip(),
            'client_ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
            'created_at' => now()->ceilDay(2)
        ]);
        User::create([
            'name' => 'User',
            'username' => 'user',
            'phone' => '09121546987',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'manager' => 0,
            'admin' => 0,
            'ip_address' => request()->ip(),
            'client_ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
            'created_at' => Carbon::yesterday()
        ]);
    }
}

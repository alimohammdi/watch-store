<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\RolesEnum;
class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // پاک کردن کش دسترسی‌ها
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ==================== نقش‌ها ====================
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin      = Role::create(['name' => 'admin']);
        $manager    = Role::create(['name' => 'manager']);
        $editor     = Role::create(['name' => 'editor']);
        $editor     = Role::create(['name' => 'writer']);

        // ==================== دسترسی‌ها (Permission) ====================
        $permissions = [
            // محصولات
            'products.view',
            'products.create',
            'products.edit',
            'products.delete',

            // سفارشات
            'orders.view',
            'orders.update',
            'orders.delete',

            // کاربران
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // تنظیمات
            'settings.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // ==================== دادن دسترسی به نقش‌ها ====================
        $superAdmin->givePermissionTo(Permission::all());
         // همه دسترسی‌ها

        $admin->givePermissionTo([
            'products.view', 'products.create', 'products.edit', 'products.delete',
            'orders.view', 'orders.update',
            'users.view',
            'settings.manage',
        ]);

        $manager->givePermissionTo([
            'products.view', 'products.edit',
            'orders.view', 'orders.update',
        ]);

        $editor->givePermissionTo([
            'products.view', 'products.edit',
        ]);

        // ==================== ساخت کاربر ادمین تست ====================
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // بعداً عوضش کن
            ]
        );
        $user->assignRole('super-admin');
    }
}

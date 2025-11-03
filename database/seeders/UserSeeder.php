<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a single Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@kadeaus.com'],
            [
                'name' => 'Admin User',
                'added_by' => '1',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );

        // Retrieve or create the Admin role for both web and api guards
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->syncRoles([$adminRole]); // full access is granted to Admin via PermissionSeeder
        // $apiRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'api']);

        // Define the modules for which permissions exist
        $modules = ['Dashboard','Appointment','Chat','Hospital','Doctors','Patients','Admins','Setting'];

        // Define the specific access level to assign (e.g., FullAccess)
        $desiredAccessLevel = 'FullAccess';

        // Assign only the desired access level for each module
        foreach ($modules as $module) {
            // Get the permission for the desired access level for the web guard
            $webPermission = Permission::where([
                'name' => "{$module}_{$desiredAccessLevel}",
                'guard_name' => 'web'
            ])->first();

            // Assign to the web role if the permission exists
            if ($webPermission) {
                $adminRole->givePermissionTo($webPermission);
            }
        }

        // Assign both web and api Admin roles to the single user
        $admin->assignRole($adminRole);
        // $admin->assignRole($apiRole);
    }
}

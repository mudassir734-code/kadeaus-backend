<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        $modules = ['Dashboard','Appointment','Chat','Hospital','Doctors','Patients','Admins','Setting'];
        $access  = ['FullAccess','ViewOnly'];

        foreach ($modules as $m) {
            foreach ($access as $lvl) {
                foreach (['web','api'] as $guard) {
                    Permission::firstOrCreate([
                        'name'       => "{$m}_{$lvl}",
                        'guard_name' => $guard,
                    ]);
                }
            }
        }

        // Ensure Admin role has all *_FullAccess (web)
        $adminRole = Role::where('name','Admin')->where('guard_name','web')->first();
        if ($adminRole) {
            $allFull = Permission::where('guard_name','web')
                ->where('name','LIKE','%_FullAccess')
                ->pluck('name')
                ->all();
            $adminRole->syncPermissions($allFull);
        }
    }
}

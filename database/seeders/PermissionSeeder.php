<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define static modules and their access levels
        $modules = [
            'Dashboard',
            'Appointment',
            'Chat',
            'Hospital',
            'Doctors',
            'Patients',
            'Admins',
            'Setting',
        ];

        $accessLevels = ['FullAccess', 'ViewOnly'];

        // // for full access for both web and api guards
        // $fullAccessPermission = 'CompletedPortalAccess';

        // // Create for both web and api guards
        // foreach (['web', 'api'] as $guard) {
        //     Permission::firstOrCreate([
        //         'name' => $fullAccessPermission,
        //         'guard_name' => $guard
        //     ]);
        // }

        // Generate permissions for static modules for both web and api guards
        foreach ($modules as $module) {
            foreach ($accessLevels as $level) {
                foreach (['web', 'api'] as $guard) {
                    Permission::firstOrCreate([
                        'name' => "{$module}_{$level}",
                        'guard_name' => $guard
                    ]);
                }
            }
        }
    }
}

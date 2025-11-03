<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $guards = ['web', 'api'];
        $roleNames = ['Admin'];

        foreach ($guards as $guard) {
            foreach ($roleNames as $name) {
                Role::firstOrCreate(['name' => $name, 'guard_name' => $guard]);
            }
        }
    }
}

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
        $guard = ['web', 'api'];
        $name = ['Admin'];

        foreach (['web','api'] as $guard) {
            foreach (['Admin','Doctor','Nurse','Patient'] as $name) {
                Role::firstOrCreate(['name' => $name, 'guard_name' => $guard]);
            }
        }
    }
}

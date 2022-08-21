<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $superAdmin = Role::create([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);
        $employee = Role::create([
            'name' => 'employee',
            'guard_name' => 'web',
        ]);
    }
}

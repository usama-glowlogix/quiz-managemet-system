<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Faker\Factory;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $factory=Factory::create();
        $user = User::create([
            'first_name' => $factory->name,
            'last_name'=>$factory->name,
            'password' => bcrypt('12345'),
            'email' => 'emp@example.com',
        ]);
        $user->assignRole('employee');
    }
}

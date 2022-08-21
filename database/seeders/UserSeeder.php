<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'first_name' => 'Usama Alam',
            'last_name' => 'Alam',
            'password' => bcrypt('12345'),
            'email' => 'admin@gmail.com',
        ]);
        $user->assignRole('super-admin');
    }
}

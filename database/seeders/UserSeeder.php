<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {

        User::updateOrCreate([
            'email' => 'admin@developer.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('Pass@786'),
            'role' => 'admin',
        ]);

        // You can add more users or customize the user creation as needed
    }
}

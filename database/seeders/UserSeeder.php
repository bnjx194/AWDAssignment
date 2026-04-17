<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        User::create([
        'name' => 'Admin User',
        'email' => 'admin@awd.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
        ]);

        User::create([
            'name' => 'John Seller',
            'email' => 'seller@awd.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);
    }
}

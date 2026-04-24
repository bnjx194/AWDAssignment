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
        // 1 Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@awd.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 4 Sellers
        User::create([
            'name' => 'John Seller',
            'email' => 'seller1@awd.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);

        User::create([
            'name' => 'Sarah Seller',
            'email' => 'seller2@awd.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);

        User::create([
            'name' => 'Mike Seller',
            'email' => 'seller3@awd.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);

        User::create([
            'name' => 'Lisa Seller',
            'email' => 'seller4@awd.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);

        // 3 Buyers
        User::create([
            'name' => 'Buyer One',
            'email' => 'buyer1@awd.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
        ]);

        User::create([
            'name' => 'Buyer Two',
            'email' => 'buyer2@awd.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
        ]);

        User::create([
            'name' => 'Buyer Three',
            'email' => 'buyer3@awd.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
        ]);
    }
}

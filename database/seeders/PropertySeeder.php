<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seller = User::where('role', 'seller')->first();

        $property = Property::create([
            'owner_id' => $seller->id,
            'description' => 'Beautiful Penthouse with city view',
            'bedrooms' => 3,
            'bathrooms' => 2.5,
            'sqft' => 1500,
        ]);

        // Seed the address using the relationship
        $property->address()->create([
            'address' => '123 Luxury Way',
            'postal_code' => '54321',
            'country' => 'Malaysia',
        ]);
    }
}

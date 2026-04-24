<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Listing;
use App\Models\User;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = Property::all();

        $prices = [
            750000, 450000, 520000, 680000, 280000,
            550000, 850000, 380000, 1200000, 320000,
            1800000, 480000
        ];

        foreach ($properties as $index => $property) {
            Listing::create([
                'property_id' => $property->id,
                'seller_id' => $property->owner_id,
                'price' => $prices[$index],
                'status' => 'active',
            ]);
        }
    }
}

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
        $property = Property::first();

        Listing::create([
            'property_id' => $property->id,
            'seller_id' => $property->owner_id,
            'price' => 750000.00,
            'status' => 'active',
        ]);
    }
}

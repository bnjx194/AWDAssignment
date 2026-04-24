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
        $sellers = User::where('role', 'seller')->get();

        $properties = [
            ['desc' => 'Luxury Penthouse with Stunning City Views', 'bed' => 3, 'bath' => 2.5, 'sqft' => 1500, 'img' => 'property 2.jpg'],
            ['desc' => 'Modern Condo in KL City Center', 'bed' => 2, 'bath' => 2, 'sqft' => 1000, 'img' => 'property 3.jpg'],
            ['desc' => 'Spacious Family Home in Subang', 'bed' => 4, 'bath' => 3, 'sqft' => 2200, 'img' => 'property 4.jpg'],
            ['desc' => 'Elegant Townhouse in Damansara Heights', 'bed' => 3, 'bath' => 2, 'sqft' => 1800, 'img' => 'property 5.jpg'],
            ['desc' => 'Cozy Studio Apartment in Bangsar', 'bed' => 1, 'bath' => 1, 'sqft' => 650, 'img' => 'property 6.jpg'],
            ['desc' => 'Premium Serviced Residence in Mont Kiara', 'bed' => 2, 'bath' => 2, 'sqft' => 1200, 'img' => 'property 7.jpg'],
            ['desc' => 'Semi-Detached House in Shah Alam', 'bed' => 5, 'bath' => 4, 'sqft' => 2800, 'img' => 'property 8.jpg'],
            ['desc' => 'Contemporary Loft in Petaling Jaya', 'bed' => 2, 'bath' => 1.5, 'sqft' => 950, 'img' => 'property 9.jpg'],
            ['desc' => 'Beachfront Villa in Port Dickson', 'bed' => 4, 'bath' => 3, 'sqft' => 2500, 'img' => 'property 10.jpg'],
            ['desc' => 'Minimalist Apartment in Cyberjaya', 'bed' => 1, 'bath' => 1, 'sqft' => 800, 'img' => 'property 11.jpg'],
            ['desc' => 'Luxury Bungalow in Ampang', 'bed' => 6, 'bath' => 5, 'sqft' => 4500, 'img' => 'property 12.jpg'],
            ['desc' => 'Modern Terrace House in Kajang', 'bed' => 3, 'bath' => 2.5, 'sqft' => 1700, 'img' => 'real-estate-home-exterior-19-1760-1000.jpg'],
        ];

        $addresses = [
            ['address' => '123 Luxury Way, Kuala Lumpur', 'postal_code' => '50000', 'country' => 'Malaysia'],
            ['address' => '456 City Center, Jalan Ampang', 'postal_code' => '50450', 'country' => 'Malaysia'],
            ['address' => '789 Subang Avenue, Selangor', 'postal_code' => '47500', 'country' => 'Malaysia'],
            ['address' => '321 Damansara Heights', 'postal_code' => '50400', 'country' => 'Malaysia'],
            ['address' => '654 Bangsar Road', 'postal_code' => '59100', 'country' => 'Malaysia'],
            ['address' => '987 Mont Kiara, Kuala Lumpur', 'postal_code' => '50480', 'country' => 'Malaysia'],
            ['address' => '147 Shah Alam, Selangor', 'postal_code' => '40000', 'country' => 'Malaysia'],
            ['address' => '258 Petaling Jaya, Selangor', 'postal_code' => '46000', 'country' => 'Malaysia'],
            ['address' => '369 Beach Road, Port Dickson', 'postal_code' => '71000', 'country' => 'Malaysia'],
            ['address' => '741 Cyberjaya, Selangor', 'postal_code' => '63000', 'country' => 'Malaysia'],
            ['address' => '852 Ampang Avenue, Kuala Lumpur', 'postal_code' => '68000', 'country' => 'Malaysia'],
            ['address' => '963 Kajang, Selangor', 'postal_code' => '43000', 'country' => 'Malaysia'],
        ];

        foreach ($properties as $index => $prop) {
            $seller = $sellers[$index % $sellers->count()];

            $property = Property::create([
                'owner_id' => $seller->id,
                'description' => $prop['desc'],
                'bedrooms' => $prop['bed'],
                'bathrooms' => $prop['bath'],
                'sqft' => $prop['sqft'],
                'image' => 'properties/' . $prop['img'],
            ]);

            $property->address()->create($addresses[$index]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingController extends Controller
{
    public function buy(Request $request)
    {
        $search = $request->query('search');
        
        // If search query exists, redirect to search route
        if ($search) {
            return redirect()->route('search', ['search' => $search]);
        }

        $listings = Listing::with('property.address')->where('status', 'active')->paginate(8);

        return view('buyPage', compact('listings'));
    }

    public function search($search)
    {
        $query = Listing::with('property.address')->where('status', 'active');

        if ($search) {
            // Case-insensitive search using LOWER() function with table prefix
            // Property table has: description, bedrooms, bathrooms, sqft, image (no 'name' column)
            $query->whereHas('property', function ($q) use ($search) {
                $q->whereRaw('LOWER(properties.description) LIKE ?', [strtolower("%{$search}%")])
                  ->orWhereHas('address', function ($q) use ($search) {
                      $q->whereRaw('LOWER(property_addresses.address) LIKE ?', [strtolower("%{$search}%")]);
                  });
            });
        }

        $listings = $query->paginate(8);

        return view('searchPage', compact('listings', 'search'));
    }
}

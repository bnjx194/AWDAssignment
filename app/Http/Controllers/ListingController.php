<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Cookie;

class ListingController extends Controller
{
    public function buy(Request $request)
    {
        $savedSearch = session('last_property_search', $request->cookie('last_property_search', ''));
        $search = $request->query('search');
        
        // Only redirect if search query is explicitly passed in URL
        if ($search) {
            return redirect()->route('search', ['search' => $search]);
        }

        // Always show all active listings on this page, regardless of saved search
        $listings = Listing::with('property.address')->where('status', 'active')->paginate(8);

        return view('buyPage', [
            'listings' => $listings,
            'searchValue' => $savedSearch,
        ]);
    }

    public function search($search)
    {
        session(['last_property_search' => $search]);
        Cookie::queue('last_property_search', $search, 60 * 24 * 30);

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

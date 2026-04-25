<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\PropertyAddress;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PropertyController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Save to all 3 tables
    public function store(Request $request)
    {
        $this->authorize('create', Property::class);

        $request->validate([
            'description' => 'required|string',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|numeric|min:1',
            'sqft' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'address' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'price' => 'required|numeric|min:1',
        ]);

        // 1. Save to properties table
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('properties', 'public');
        }

        $property = Property::create([
            'owner_id' => Auth::id(),
            'description' => $request->description,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'sqft' => $request->sqft,
            'image' => $imagePath,
        ]);

        // 2. Save to property_addresses table
        PropertyAddress::create([
            'property_id' => $property->id,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        // 3. Save to listings table
        Listing::create([
            'property_id' => $property->id,
            'seller_id' => Auth::id(),
            'price' => $request->price,
            'status' => 'active',
        ]);

        return redirect('/buy');
    }
    public function show(Request $request, $id)
    {
        $property = Property::with('address')->findOrFail($id);
        $listing = Listing::where('property_id', $id)->first();

        $recentlyViewed = session('recently_viewed_properties');
        if (!is_array($recentlyViewed)) {
            $recentlyViewed = json_decode($request->cookie('recently_viewed_properties', '[]'), true);
        }
        if (!is_array($recentlyViewed)) {
            $recentlyViewed = [];
        }

        $recentlyViewed = array_values(array_filter($recentlyViewed, function ($propertyId) use ($id) {
            return (int) $propertyId !== (int) $id;
        }));
        array_unshift($recentlyViewed, (int) $id);
        $recentlyViewed = array_slice($recentlyViewed, 0, 5);

        session(['recently_viewed_properties' => $recentlyViewed]);

        $recentProperties = Property::with('address')
            ->whereIn('id', $recentlyViewed)
            ->where('id', '!=', $property->id)
            ->get()
            ->sortBy(function ($item) use ($recentlyViewed) {
                return array_search($item->id, $recentlyViewed);
            })
            ->values();

        return response()
            ->view('propertyDetail', compact('property', 'listing', 'recentlyViewed', 'recentProperties'))
            ->cookie('recently_viewed_properties', json_encode($recentlyViewed), 60 * 24 * 30);
    }
}
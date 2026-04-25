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



    public function index()
    {
        // Fetch all properties along with their addresses (Eager Loading)
        $properties = Property::with('address')->get();

        // Return the view and pass the data
        return view('propertyPage', compact('properties'));
    }

    // Save to all 3 tables
    public function store(Request $request)
    {
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
    public function show($id)
    {
        $property = Property::with('address')->findOrFail($id);
        $listing = Listing::where('property_id', $id)->first();
        return view('propertyDetail', compact('property', 'listing'));
    }
}
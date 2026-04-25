<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ListingController extends Controller
{
    public function buy()
    {
        $listings = Listing::with('property.address')->where('status', 'active')->paginate(8);

        return view('buyPage', compact('listings'));
    }
}

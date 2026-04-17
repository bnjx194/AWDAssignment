<?php

namespace App\Http\Controllers;
use App\Models\Property;
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

    public function show($id)
    {
        $property = Property::with('address')->findOrFail($id);
        return view('properties.show', compact('property'));
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\Lease;
use App\Models\Property;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $leases = Lease::all();
        $properties = Property::all();
        $furnitures = Furniture::all();
        // dd($properties);
        return view('landing.index', compact('furnitures', 'leases', 'properties'));
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('landing.properties.show', compact('property'));
    }

}

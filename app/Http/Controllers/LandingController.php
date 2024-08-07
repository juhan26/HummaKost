<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\Lease;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $users = User::role('member')->latest()->paginate(10);      
        $leases = Lease::all();
        $properties = Property::latest()->paginate(6);
        $furnitures = Furniture::all();
        // dd($properties);
        return view('landing.index', compact('furnitures', 'leases', 'properties', 'users'));
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('landing.properties.show', compact('property'));
    }
}

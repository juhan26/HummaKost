<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyFurnitureRequest;
use App\Models\Facility;
use App\Models\Furniture;
use App\Models\Property;
use App\Models\PropertyFurniture;
use Illuminate\Http\Request;

class PropertyFurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $properties = Property::with('furnitures')->latest()->paginate(10);
        $furnitures = Facility::all();

        if ($request->search) {
            $properties = Property::where('name', 'LIKE', "%{$request->input('search')}%")
            ->paginate(10);

        } else {
            $properties = Property::latest()->paginate(10);
        }

        return view('pages.property_and_furnitures.index', compact('properties', 'furnitures'));
    }

    /**
     * Show the form for creating a new resource.-
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyFurnitureRequest $request)
    {
        PropertyFurniture::where('property_id', $request->property_id)->delete();
        $furniture_id = $request->furniture_id;

        foreach ($furniture_id as $furniture) {
            PropertyFurniture::create([
                'property_id' => $request->property_id,
                'furniture_id' => $furniture,
            ]);
        }

        return redirect()->route('property_furnitures.index')->with('success', 'Data berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show(PropertyFurniture $propertyFurniture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyFurniture $propertyFurniture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyFurniture $propertyFurniture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyFurniture $propertyFurniture)
    {
        //
    }
}

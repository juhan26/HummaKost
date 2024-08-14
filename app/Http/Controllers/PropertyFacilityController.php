<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Property;
use App\Models\PropertyFacility;
use Illuminate\Http\Request;

class PropertyFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $properties = Property::with('furnitures')->latest()->paginate(10);
        $facilities = Facility::all();

        if ($request->search) {
            $properties = Property::where('name', 'LIKE', "%{$request->input('search')}%")
                ->paginate(10);
        } else {
            $properties = Property::latest()->paginate(10);
        }

        return view('pages.property_and_facilities.index', compact('properties', 'facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PropertyFacility::where('property_id', $request->property_id)->delete();
        $facility_id = $request->facility_id;

        foreach ($facility_id as $facility) {
            PropertyFacility::create([
                'property_id' => $request->property_id,
                'facility_id' => $facility,
            ]);
        }

        return redirect()->route('property_facilities.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyFacility $propertyFacility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyFacility $propertyFacility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyFacility $propertyFacility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyFacility $propertyFacility)
    {
        //
    }
}

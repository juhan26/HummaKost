<?php

namespace App\Http\Controllers;

use App\Models\PropertyImage;
use Illuminate\Http\Request;

class PropertyImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $photo = $request->images;
        $photoPath = $photo->store('property_detail_photos', 'public');

        PropertyImage::create([
            'property_id'=>$request->property_id,
            'image'=> $photoPath,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyImage $propertyImage)
    {
        //
    }
}

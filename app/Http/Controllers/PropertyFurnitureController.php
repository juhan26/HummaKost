<?php

namespace App\Http\Controllers;

use App\Models\PropertyFurniture;
use Illuminate\Http\Request;

class PropertyFurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propertyFurnitures = PropertyFurniture::all();
        return view('pages.property_and_furnitures.index', compact('propertyFurnitures'));
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
    public function store(Request $request)
    {
        //
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

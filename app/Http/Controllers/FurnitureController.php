<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFurnitureRequest;
use App\Http\Requests\UpdateFurnitureRequest;
use App\Models\Furniture;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $furnitures = Furniture::latest()->paginate(10);
        return view('pages.furnitures.index', compact('furnitures'));
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
    public function store(StoreFurnitureRequest $request)
    {
        Furniture::create($request->all());
        return redirect()->route('furnitures.index')->with('success', "Successful Created Furniture");
    }

    /**
     * Display the specified resource.
     */
    public function show(Furniture $furniture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Furniture $furniture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Furniture $furniture)
    {
        $furniture->update($request->all());
        return redirect()->route('furnitures.index')->with('success', "Successful Updated Furniture");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Furniture $furniture)
    {
        try {
            $furniture->delete();
            return redirect()->route('furnitures.index')->with('success', "Successful Deleted Furniture");
        } catch (QueryException $e) {
            return redirect()->route('furnitures.index')->with('errorr', "Failed to delete this furniture because it is currently use in a Property");
        }
    }
}

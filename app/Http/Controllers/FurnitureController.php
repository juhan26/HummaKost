<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFurnitureRequest;
use App\Http\Requests\UpdateFurnitureRequest;
use App\Models\Furniture;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $furnitures = Furniture::where('name', 'LIKE', "%" . $request->search . "%")->paginate(6);
        } else {
            $furnitures = Furniture::latest()->paginate(6);
        }
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

        if ($request->photo) {
            $photoPath = $request->photo->store('furniture_photos', 'public');
            Furniture::create([
                'photo' => $photoPath,
                'name' => $request->name,
                'description' => $request->description,
            ]);
        } else {
            Furniture::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        return redirect()->route('furnitures.index')->with('success', "Berhasil Menambah Furniture Baru");
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
    public function update(UpdateFurnitureRequest $request, Furniture $furniture)
    {
        if ($request->photo) {

            if ($furniture->photo) {
                Storage::delete('public/' . $furniture->photo);
            }

            $newPhoto = $request->photo->store('furniture_photos', 'public');

            $furniture->update([
                'photo' => $newPhoto,
                'name' => $request->name,
                'description' => $request->description,
            ]);
        } else {
            $furniture->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        return redirect()->route('furnitures.index')->with('success', "Berhasil Mengubah Furniture");
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

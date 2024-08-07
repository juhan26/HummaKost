<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaseRequest;
use App\Http\Requests\UpdateLeaseRequest;
use App\Models\Lease;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leases = Lease::latest()->paginate(6);
        $users = User::all();
        $properties = Property::all();
        return view('pages.leases.index', compact('leases', 'users', 'properties'));
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
    public function store(StoreLeaseRequest $request)
    {
        Lease::create([
            'user_id' => $request->user_id,
            'property_id' => $request->property_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'description' => $request->description,
            'total_iuran' => $request->total_iuran,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('leases.index')->with('success', 'Lease successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $lease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lease $lease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaseRequest $request, Lease $lease)
    {
        $lease->update($request->all());
        return redirect()->route('leases.index')->with('success', 'Lease successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease)
    {
        try {
            $lease->delete();
            return redirect()->route('leases.index')->with('success', 'Leases Deleted Success');
        } catch (\Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('leases.index')->with('error', 'Cannot delete this lease because he/she has related data in other tables');
            }
        }
    }
}

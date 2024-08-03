<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFinancialRequest;
use App\Http\Requests\UpdateFinancialRequest;
use App\Models\Financial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('member')) {
            $financials = Financial::where('user_id', Auth::user()->id)->latest()->paginate(10);
        } else {
            $financials = Financial::latest()->latest()->paginate(10);
        }
        return view('pages.financials.index', compact('financials'));
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
    public function store(StoreFinancialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Financial $financial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Financial $financial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinancialRequest $request, Financial $financial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Financial $financial)
    {
        //
    }
}

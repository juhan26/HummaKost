<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Lease;
use App\Models\PaymentPerMonth;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaymentPerMonthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = PaymentPerMonth::all();
        $leases = Lease::all();
        return view('pages.payments.index', compact('payments', 'leases'));
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
    public function store(StorePaymentRequest $request)
    {
        $lease = Lease::find($request->lease_id);

        $nominal = $lease->properties->rental_price;

        $total_lease = $lease->total_iuran / $nominal;
        $date =  Carbon::parse($lease->end_date);
        $date->subMonths($total_lease);
        $leasesPaymentMonth = $date->format('F');

        if ($total_lease <= 0) {
            return redirect()->route('payments.index')->with('error', 'User Sudah Lunas');
        } else {
            PaymentPerMonth::create([
                'lease_id' => $request->lease_id,
                'month' => $leasesPaymentMonth,
                'nominal' => $nominal,
                'description' => $request->description,
            ]);
            $currentPrice = $lease->total_iuran - $nominal;

            $lease->update([
                'total_iuran' => $currentPrice
            ]);
        }
        return redirect()->route('payments.index')->with('success', 'Payment saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentPerMonth $paymentPerMonth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentPerMonth $paymentPerMonth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentPerMonth $paymentPerMonth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentPerMonth $payment)
    {
        try {
            $lease = Lease::find($payment->lease_id);
            $nominal = $lease->properties->rental_price;
            $updatePrice = $lease->total_iuran + $nominal;
            $lease->update([
                'total_iuran' => $updatePrice
            ]);
            $payment->delete();
            return redirect()->route('payments.index')->with('success', "Successful Deleted Payment");
        } catch (QueryException $e) {
            return redirect()->route('payments.index')->with('errorr', "Failed to delete this Payment because it is currently use in a Property");
        }
    }
}

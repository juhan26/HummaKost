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
    public function index(Request $request)
    {
        $query = PaymentPerMonth::with('lease.user');

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('lease.user', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            })
                ->orWhere('month', 'LIKE', '%' . $search . '%');
        }

        $payments = $query->with('lease')->latest()->paginate(5);
        $leases = Lease::with('user')->where('status', 'active')->paginate(5);

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
        $totalNominal = $lease->total_nominal + $nominal;
        $totalKurangi = $lease->total_iuran - $totalNominal;
        $total_lease = $totalKurangi / $nominal;
        $date =  Carbon::parse($lease->end_date);
        $date->subMonths($total_lease + 1);
        $leasesPaymentMonth = $date->format('F');

        if ($lease->total_iuran <= $lease->total_nominal) {
            return redirect()->route('payments.index')->with('error', 'Pengguna Sudah Lunas');
        } else {

            PaymentPerMonth::create([
                'lease_id' => $request->lease_id,
                'month' => $leasesPaymentMonth,
                'nominal' => $nominal,
                'description' => $request->description,
            ]);


            $lease->update([
                'total_nominal' => $totalNominal,
            ]);
        }
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil di simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($paymentPerMonth)
    {
        $lease = Lease::with('user', 'payments')->find($paymentPerMonth);
        return view('pages.payments.detail', compact('lease'));
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
            $updatePrice = $lease->total_nominal - $lease->properties->rental_price;
            $lease->update([
                'total_nominal' => $updatePrice
            ]);
            $payment->delete();
            return redirect()->route('payments.index')->with('success', "Pembayaran berhasil di hapus");
        } catch (QueryException $e) {
            return redirect()->route('payments.index')->with('errorr', "Tidak dapat menghapus pembayaran ini karena data memiliki data terkait di tabel lain");
        }
    }
}

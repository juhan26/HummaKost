<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Lease;
use App\Models\PaymentPerMonth;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentPerMonthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $month = $request->month;
        $year = $request->year;
        $paymentMonth = $month . ' ' . $year;
        $status = $request->input('status', []);
        if (Auth::user()->hasRole('super_admin')) {
            $query = Lease::with(['user', 'payments']);

            if ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })->orWhereHas('properties', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            }

            if (!empty($status)) {
                $query->whereIn('property_id', $status);
            }

            if ($month && $year) {
                $query->whereHas('payments', function ($query) use ($paymentMonth) {
                    $query->where('payment_month', 'LIKE', "%" . $paymentMonth . "%");
                });
            }

            $query->orderByRaw("CASE WHEN total_nominal >= total_iuran THEN 1 ELSE 0 END")->latest();

            $leases = $query->paginate(6);

            $leases->appends([
                'search' => $search,
                'status' => $status,
                'month' => $month,
                'year' => $year,
            ]);

            $payments = PaymentPerMonth::all();
            $properties = Property::all();
        } else {
            $query = Lease::with(['user', 'payments']);

            if (Auth::user()->lease) {
                $query->whereHas('properties', function ($query) {
                    $query->where('id', Auth::user()->lease->property_id);
                });
            }

            if ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            }

            // if (!empty($status)) {
            //     $query->whereIn('property_id', $status);
            // }

            if ($month && $year) {
                $query->whereHas('payments', function ($query) use ($paymentMonth) {
                    $query->where('payment_month', 'LIKE', "%" . $paymentMonth . "%");
                });
            }

            $leases = $query->orderByRaw("CASE WHEN total_nominal >= total_iuran THEN 1 ELSE 0 END")
                ->latest()
                ->paginate(6);

            $leases->appends([
                'search' => $search,
                'status' => $status,
            ]);

            $payments = PaymentPerMonth::all();
            $properties = Property::all();
        }

        return view('pages.payments.index', compact('payments', 'leases', 'status', 'properties'));
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

        if (!$lease) {
            return redirect()->route('payments.index')->with('error', 'Lease tidak ditemukan.');
        }

        $nominal = $request->rental_price; //600 000

        if ($lease->total_nominal >= $lease->total_iuran) {
            return redirect()->route('payments.index')->with('error', 'Pengguna Sudah Lunas');
        }

        $totalNominal = $lease->total_nominal + $nominal;

        $startDate = \Carbon\Carbon::parse($lease->start_date);

        $totalMonthsPaid = floor($lease->total_nominal / $lease->properties->rental_price);

        $monthsToAdd = floor($nominal / $lease->properties->rental_price);

        $startPaymentMonth = $startDate->copy()->addMonths($totalMonthsPaid);

        $paymentMonth = $startDate->copy()->addMonths($totalMonthsPaid + $monthsToAdd);

        $startPaymentMonthFormatted = $startPaymentMonth->format('d F Y');
        $paymentMonthFormatted = $paymentMonth->format('d F Y');

        PaymentPerMonth::create([
            'lease_id' => $request->lease_id,
            'payment_month' => $startPaymentMonthFormatted,
            'month' => $paymentMonthFormatted,
            'nominal' => $nominal,
            'description' => $request->description,
        ]);

        $lease->update([
            'total_nominal' => $totalNominal,
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil disimpan');
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

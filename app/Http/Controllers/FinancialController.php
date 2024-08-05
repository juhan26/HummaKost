<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFinancialRequest;
use App\Http\Requests\UpdateFinancialRequest;
use App\Models\Financial;
use Carbon\Carbon;
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

        $totalIncome = Financial::where('user_id', Auth::user()->id)
            ->where('types', 'Income')
            ->where('status', 'Accepted')
            ->sum('nominal');

        $startDate = Auth::user()->created_at->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $currentDate = date('Y-m-d');
        $startDateTimestamp = strtotime($startDate);
        $currentDateTimestamp = strtotime($currentDate);
        $daysDifference = ($currentDateTimestamp - $startDateTimestamp) / (60 * 60 * 24) + 1;
        $dailyPayment = 10000;
        $totalPaymentExpected = $daysDifference * $dailyPayment;

        if ($totalIncome < $totalPaymentExpected) {
            $outstandingPayment = $totalPaymentExpected - $totalIncome;
        } else {
            $outstandingPayment = 0;
        }

        return view('pages.financials.index', compact('financials', 'outstandingPayment', 'totalIncome'));
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

        $payment_proof_path = $request->payment_proof->store('payment_proofs', 'public');
        $lastFinancial = Financial::where('user_id', Auth::user()->id)->latest()->first();
        if ($request->types === "Income") {
            if ($lastFinancial) {
                Financial::create([
                    'user_id' => $request->user_id,
                    'amount' => $lastFinancial->amount,
                    'types' => $request->types,
                    'nominal' => $request->nominal,
                    'payment_proof' => $payment_proof_path,
                    'financial_date' => $request->financial_date,
                    'has_paid_until' => $lastFinancial->has_paid_until,
                    // 'total_income' => $lastFinancial->total_income,
                ]);
            } else {
                $startDate = Auth::user()->created_at->setTimezone('Asia/Jakarta')->format('Y-m-d'); //28
                $currentDate = date('Y-m-d');
                $startDateTimestamp = strtotime($startDate);
                $currentDateTimestamp = strtotime($currentDate);
                if ($startDateTimestamp === $currentDateTimestamp) {
                    $daysDifference = ($currentDateTimestamp / $startDateTimestamp);
                } else {
                    $daysDifference = ($currentDateTimestamp - $startDateTimestamp) / (60 * 60 * 24) + 1; //4
                }
                $incomeDateRaw = Carbon::parse($currentDate);
                $income_date = $incomeDateRaw->subDays($daysDifference)->format('Y-m-d');
                Financial::create([
                    'user_id' => $request->user_id,
                    'amount' => 0,
                    'types' => $request->types,
                    'nominal' => $request->nominal,
                    'payment_proof' => $payment_proof_path,
                    'financial_date' => $request->financial_date,
                    'has_paid_until' => $income_date,
                    // 'total_income' => 0,
                ]);
            }
        } else {
            return "next feathure";
        }

        return redirect()->route('financial.index')->with('success', 'Successful Create Financial');
    }

    /**
     * Display the specified resource.
     */
    public function accept(Financial $financial)
    {
        $paidDays = $financial->nominal / 10000;
        $lastHasPaidUntil = Carbon::parse($financial->has_paid_until);

        if (Financial::count() === 0) {
            $newAmount = Financial::sum('amount') + $financial->nominal;
            // $newTotalIncome = Financial::sum('nominal') + $financial->nominal;
            $financial->update([
                'amount' => $newAmount,
                'has_paid_until' => $lastHasPaidUntil->addDays($paidDays)->format('Y-m-d'),
                'status' => 'Accepted',
                // 'total_income' => $newTotalIncome,
            ]);
        } else {
            $newAmount = Financial::latest('id')->first()->amount + $financial->nominal;
            // $newTotalIncome = Financial::where('user_id', Auth::user()->id)->latest('id')->first()->total_income + $financial->nominal;
            $financial->update([
                'amount' => $newAmount,
                'has_paid_until' => $lastHasPaidUntil->addDays($paidDays)->format('Y-m-d'),
                'status' => 'Accepted',
                // 'total_income' => $newTotalIncome
            ]);
        }

        return redirect()->route('financial.index')->with('success', 'Successful Accepted Financial');
    }

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

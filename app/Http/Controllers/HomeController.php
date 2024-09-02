<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Instance;
use App\Models\Lease;
use App\Models\PaymentPerMonth;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $propertiesCount = Property::count();
        $instanceCount = Instance::count();
        $usersCount = User::count();
        $leasesCount = Lease::count();
        $facilityCount = Facility::count();

        $userAccepted = User::where('status', 'accepted')->count();
        $userRejected = User::where('status', 'rejected')->count();
        $userPending = User::where('status', 'pending')->count();

        $leases = Lease::with(['user', 'payments'])->latest()->get();

        $currentMonth = Carbon::now()->month;


        $paymentIncome = PaymentPerMonth::selectRaw('MONTH(created_at) as month, SUM(nominal) as total')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->whereMonth('created_at', '<=', $currentMonth)
            ->orderBy('month')
            ->pluck('total', 'month');


        $incomeMonthlyTotals = array_fill(1, $currentMonth, 0);
        foreach ($paymentIncome as $month => $total) {
            $incomeMonthlyTotals[$month] = $total;
        }


        $latePayments = DB::table('leases')
            ->join('payment_per_months', 'leases.id', '=', 'payment_per_months.lease_id')
            ->select(
                'leases.user_id',
                DB::raw('MONTH(payment_per_months.created_at) as month'),
                DB::raw('GREATEST(0, DATEDIFF(payment_per_months.payment_date, payment_per_months.due_date)) as days_late')
            )
            ->where('payment_per_months.payment_date', '>', 'payment_per_months.due_date')
            ->get();


        $lateData = [];
        for ($i = 1; $i <= $currentMonth; $i++) {
            $monthYear = Carbon::create(null, $i)->format('F');
            $lateData[$monthYear] = [];
        }

        // data yang telat byayar
        foreach ($latePayments as $payment) {
            $monthYear = Carbon::create(null, $payment->month)->format('F');
            if (!isset($lateData[$monthYear][$payment->user_id])) {
                $lateData[$monthYear][$payment->user_id] = 0;
            }
            $lateData[$monthYear][$payment->user_id] += $payment->days_late;
        }



        $properties = Property::with(['leases' => function ($query) use ($currentMonth) {
            $query->selectRaw('property_id, MONTH(created_at) as month, COUNT(*) as total')
                ->whereMonth('created_at', '<=', $currentMonth)
                ->groupBy('property_id', 'month')
                ->orderBy('month');
        }])->get();

        $leasesPerMonth = [];
        foreach ($properties as $property) {
            $data = array_fill(0, $currentMonth, 0);
            foreach ($property->leases as $lease) {
                if ($lease->month <= $currentMonth) {
                    $data[$lease->month - 1] = $lease->total;
                }
            }
            $leasesPerMonth[] = [
                'name' => $property->name,
                'data' => $data,
            ];
        }

        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->get();

        return view('pages.dashboard.index', compact(
            'leases',
            'incomeMonthlyTotals',
            'leasesPerMonth',
            'userAccepted',
            'userRejected',
            'userPending',
            'propertiesCount',
            'usersCount',
            'leasesCount',
            'facilityCount',
            'instanceCount',
            'users',
            'lateData'
        ));
    }
}

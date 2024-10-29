<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\AnnualCountingController;
use App\Http\Controllers\Controller;
use App\Models\Annualeave;
use App\Models\Employes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApplyingDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;

        $employee = Employes::with('role_annual')->where('user_id', $id)->first();

        if (empty($employee->role_annual)) {
           Session::flash('info', 'Your leave application page is not ready, please contact admininstrator.');
           return redirect()->route('dashboard');
        }

        $annualControler = new AnnualCountingController();

        $monthComming = $annualControler->monthComming($employee->join_contract);

        $monthComming = $monthComming - $employee->role_annual->takenAnnual;

        $month = 0;

        $adv = 0;

        if ($employee->end_contract) {
            # code...
            $month = $annualControler->month($employee->join_contract, $employee->end_contract);
            $month = $month - $employee->role_annual->takenAnnual;
            $adv = $month - $monthComming;
        }

        if ($employee->emp_status === "Permanent") {
            $month = $employee->role_annual->annual;
        }


        if (empty($employee->role_annual)) {
            return redirect()->back();
        }

        return view('template_admin.applying_leave.dashboard.index', compact(['employee', 'month', 'monthComming', 'adv']));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('template_admin.applying_leave.dashboard.show-print');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

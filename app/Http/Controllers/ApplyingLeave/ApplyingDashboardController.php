<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\AnnualCountingController;
use App\Http\Controllers\Controller;
use App\Models\Annualeave;
use App\Models\Employes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyingDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;

        $employee = Employes::where('user_id', $id)->first();

        $annualControler = new AnnualCountingController();

        $monthComming = $annualControler->monthComming($employee->join_contract);

        $month = 0;

        if ($employee->end_contract) {
            # code...
            $month = $annualControler->month($employee->join_contract, $employee->end_contract);
        }

        $annualeave = Annualeave::where('employes_id', $employee->id)->first();

        return view('template_admin.applying_leave.dashboard.index', compact(['employee', 'month', 'monthComming', 'annualeave']));
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
        //
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

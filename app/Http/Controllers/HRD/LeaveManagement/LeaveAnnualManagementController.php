<?php

namespace App\Http\Controllers\HRD\LeaveManagement;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HRD\Employes\CustomEmployesController;
use App\Models\Annualeave;
use App\Models\Department;
use App\Models\Employes;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class LeaveAnnualManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('template_admin.hrd.leave-management.annual.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = Employes::find($request->id);

        $dataAnnual = [
            'employes_id'   => $employee->id,
            'nik'           => $employee->nik,
            'annual'        => $request->annual,
            'totalAnnual'   => $request->annual,
        ];

        $dataEmployee = [
            'join_contract'     => $request->joinContractPUT,
            'end_contract'      => $request->endContractPUT
        ];

        Annualeave::create($dataAnnual);

        $employee->update($dataEmployee);

        Session::flash('success', $employee->fullname() . ' annual created!!');
        Session::flash('info', $employee->fullname() . ' contract updated!!');

        return redirect()->route('leave-management-annual.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employes::with(['role_annual'])->find($id);

        return view('template_admin.hrd.leave-management.annual.show', compact(['employee']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employes::with(['role_annual'])->find($id);

        return view('template_admin.hrd.leave-management.annual.create', compact(['employee']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $annualeave = Annualeave::where('employes_id', $id)->first();
        $totalAnnual = $annualeave->totalAnnual + $request->annual;
        $annual = $annualeave->annual + $request->annual;

        $employee = Employes::find($id);

        $dataAnnual = [
            'annual'        => $annual,
            'totalAnnual'   => $totalAnnual
        ];

        $dataEmployee = [
            'join_contract'     => $request->joinContractPUT,
            'end_contract'      => $request->endContractPUT
        ];

        $annualeave->update($dataAnnual);
        $employee->update($dataEmployee);

        Session::flash('success', $employee->fullname() . ' annual updated!!');
        Session::flash('info', $employee->fullname() . ' contract updated!!');

        return redirect()->route('leave-management-annual.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

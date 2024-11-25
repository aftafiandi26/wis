<?php

namespace App\Http\Controllers\HRD\EmployeeLeave;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HRD\Employes\CustomEmployesController;
use App\Models\Department;
use App\Models\Employes;
use App\Models\LeaveTransaction;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeLeaveDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveTransactions = LeaveTransaction::where('ver_hrd', false)->get();

        return view('template_admin.hrd.employee-leave.dashboard.index', compact('leaveTransactions'));
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
        $employee = Employes::find($id);

        return view('template_admin.hrd.employee-leave.dashboard.show-list-annual', compact(['employee', 'id']));
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

<?php

namespace App\Http\Controllers\HRD\LeaveManagement;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HRD\Employes\CustomEmployesController;
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
        $employee = Employes::with(['role_annual'])->find($id);

        return view('template_admin.hrd.leave-management.annual.show', compact(['employee']));
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

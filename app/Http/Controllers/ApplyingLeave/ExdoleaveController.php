<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\AnnualCountingController;
use App\Http\Controllers\Controller;
use App\Models\Employes;
use App\Models\LeaveCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExdoleaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = Employes::with(['role_user', 'role_annual'])->where('user_id', Auth::user()->id)->first();

        $leaveCategory = LeaveCategory::find(2);

        $customApplying = new CustomApplyingLeaveController();

        $getProvinces = $customApplying->getProvinces();

        $getEmpHod = Employes::where('department_id', $employee->department_id)->get();

        $user_hod = $customApplying->user_hod();

        $user_coor = $customApplying->user_coor();
        $user_spv = $customApplying->user_spv();
        $user_pm = $customApplying->user_pm();
        $user_producer = $customApplying->user_producer();

        $exdo = $employee->role_annual->exdo - $employee->role_annual->takenExdo;

        return view('template_admin.applying_leave.exdo.create', compact(['employee', 'getProvinces', 'user_hod', 'exdo', 'user_coor', 'user_spv', 'user_pm', 'user_producer', 'leaveCategory']));
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

<?php

namespace App\Http\Controllers\HRD\Annual;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HRD\Employes\CustomEmployesController;
use App\Models\Department;
use App\Models\Employes;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('template_admin.hrd.employes.annual.index');
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
        $departments = Department::all();

        $projects = Project::where('active', true)->orderBy('name', 'asc')->get();

        $noImg = asset(Storage::url("no-image.jpeg"));

        $employee = Employes::with(['role_annual'])->find($id);

        $active = $employee->active;

        $controller = new CustomEmployesController();

        $monthComming = $controller->monthComming($employee->join_contract);

        $result = 0;
        $supClass = "supClass1";

        if ($employee->role_annual) {
            $result = $employee->role_annual->totalAnnual - $employee->role_annual->takenAnnual - $monthComming;
            $result = "+$result";
            $supClass = "supClass2";
        }

        if ($employee->profile_pic) {
            $noImg = asset(Storage::url("public/avatars/$employee->profile_pic"));
        }

        if ($active == true) {
            $st = "Deactived";
            $class = "fas fa-user-alt-slash";
            $btn = "btn-danger";
        } else {
            $class = "fas fa-user";
            $btn = "btn-success";
            $st = "Actived";
        }

        return view('template_admin.hrd.employes.annual.show', compact(['departments', 'projects', 'noImg', 'employee', 'st', 'class', 'btn', 'result', 'supClass', 'monthComming']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employes::find($id);

        return view('template_admin.hrd.employes.annual.edit', compact(['employee']));
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

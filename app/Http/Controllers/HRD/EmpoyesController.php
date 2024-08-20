<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Http\Requests\HRD\Employes\StoreRequest;
use App\Models\Department;
use App\Models\Employes;
use App\Models\Project;
use Illuminate\Http\Request;

class EmpoyesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $employes = Employes::where('active', true)->get();

        return view('template_admin.hrd.employes.dashboard', compact(['employes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();

        $projects = Project::orderBy('name', 'asc')->get();

        return view('template_admin.hrd.employes.create', compact(['departments', 'projects']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        dd($validated);

        return redirect()->route('employes.index')->with('success', 'Data berhasil disimpan!');
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

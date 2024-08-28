<?php

namespace App\Http\Controllers\HRD\Employes;

use App\Http\Controllers\Controller;
use App\Http\Requests\HRD\Employes\StoreRequest;
use App\Models\Annualeave;
use App\Models\Department;
use App\Models\Employes;
use App\Models\Project;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmpoyesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function month($start, $end)
    {
        // Tanggal awal
        $startDate = new DateTime($start);

        // Tanggal akhir
        $endDate = new DateTime($end);

        // Menghitung selisih
        $interval = $startDate->diff($endDate);

        $increment = 0;

        if ($interval->d >= 28) {
            $increment = 1;
        }

        // Mendapatkan jumlah bulan
        $months = ($interval->y * 12) + $interval->m + $increment;

        return $months;
    }

    public function index()
    {
        $employes = Employes::where('active', true)->get();

        return view('template_admin.hrd.employes.dashboard.dashboard', compact(['employes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();

        $projects = Project::orderBy('name', 'asc')->get();

        $noImg = asset(Storage::url("no-image.jpeg"));

        return view('template_admin.hrd.employes.dashboard.create', compact(['departments', 'projects', 'noImg']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $months = $this->month($request->joinDate, $request->endDate);

        $fileName = null;

        if ($request->hasFile('file')) {
            $file = $request->file;

            // Menentukan nama file dengan ekstensi yang sesuai
            $fileName = $request->nik . '.' . $file->getClientOriginalExtension();

            // Menyimpan file di direktori avatars dengan nama yang sudah ditentukan
            $file->storeAs('avatars', $fileName, 'public');
        }

        $jsonProject = json_encode($request->project);

        $data = [
            'nik'               => $request->nik,
            'first_name'        => Str::title($request->firstName),
            'last_name'         => Str::title($request->lastName),
            'gender'            => $request->gender,
            'department_id'     => $request->department,
            'position'          => $request->position,
            'emp_status'        => $request->empStat,
            'join_contract'     => $request->joinDate,
            'end_contract'      => $request->endDate,
            'bod'               => $request->bod,
            'pob'               => Str::title($request->pob),
            'province'          => Str::title($request->province),
            'maiden'            => Str::title($request->maiden),
            'id_card'           => $request->ktp,
            'address'           => $request->address,
            'area'              => $request->area,
            'city'              => $request->city,
            'education'         => $request->education,
            'institution'       => $request->institution,
            'marital_status'    => $request->marital,
            'npwp'              => $request->npwp,
            'kk'                => $request->kk,
            'religion'          => $request->religion,
            'bpjs_ketenagakerjaan'  => $request->ketenagakerjaan,
            'bpjs_kesehatan'        => $request->kesehatan,
            'project_id'            => $jsonProject,
            'active'                => true,
            'profile_pic'           => $fileName,
        ];

        // dd($data);

        Employes::create($data);

        $getEmp = Employes::where('nik', $request->nik)->where('active', true)->latest()->first();

        $dataAnnual = [
            'totalAnnual'   => $months,
            'employes_id'   => $getEmp->id,
            'nik'           => $request->nik
        ];

        Annualeave::create($dataAnnual);

        return redirect()->route('employes.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $departments = Department::all();

        $projects = Project::orderBy('name', 'asc')->get();

        $noImg = asset(Storage::url("no-image.jpeg"));

        return view('template_admin.hrd.employes.dashboard.show', compact(['departments', 'projects', 'noImg']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departments = Department::all();

        $projects = Project::orderBy('name', 'asc')->get();

        $noImg = asset(Storage::url("no-image.jpeg"));

        return view('template_admin.hrd.employes.dashboard.edit', compact(['departments', 'projects', 'noImg']));
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

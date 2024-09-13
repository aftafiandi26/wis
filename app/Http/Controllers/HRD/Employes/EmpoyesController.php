<?php

namespace App\Http\Controllers\HRD\Employes;

use App\Http\Controllers\Controller;
use App\Http\Requests\HRD\Employes\StoreRequest;
use App\Http\Requests\HRD\Employes\UpdateRequest;
use App\Models\Annualeave;
use App\Models\Department;
use App\Models\Employes;
use App\Models\Project;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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

        $projects = Project::where('active', true)->orderBy('name', 'asc')->get();

        $noImg = asset(Storage::url("no-image.jpeg"));

        return view('template_admin.hrd.employes.dashboard.create', compact(['departments', 'projects', 'noImg']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $controllerMonth = new CustomEmployesController();

        if ($request->empStat !== "Permanent") {
            $months = $controllerMonth->month($request->joinDate, $request->endDate);
        }


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
            'nationally'            => $request->nationally,
            'wfh'                   => $request->workStat
        ];

        // dd($data);

        Employes::create($data);

        if ($request->empStat !== "Permanent") {

            $getEmp = Employes::where('nik', $request->nik)->where('active', true)->latest()->first();

            $dataAnnual = [
                'totalAnnual'   => $months,
                'employes_id'   => $getEmp->id,
                'nik'           => $request->nik
            ];

            Annualeave::create($dataAnnual);
        }

        return redirect()->route('employes.index')->with('success', 'Data successfully saved!!!');
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

        return view('template_admin.hrd.employes.dashboard.show', compact(['departments', 'projects', 'noImg', 'employee', 'st', 'class', 'btn', 'result', 'supClass', 'monthComming']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departments = Department::all();

        $projects = Project::where('active', true)->orderBy('name', 'asc')->get();

        $noImg = asset(Storage::url("no-image.jpeg"));

        $employee = Employes::find($id);

        $projectID = json_decode($employee->project_id, true);

        if ($employee->profile_pic) {
            $noImg = asset(Storage::url("avatar/$employee->profile_pic"));
        }

        return view('template_admin.hrd.employes.dashboard.edit', compact(['departments', 'projects', 'noImg', 'employee', 'projectID']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        $controllerMonth = new CustomEmployesController();

        if ($request->empStat == "Contract") {
            $months = $controllerMonth->month($request->joinDate, $request->endDate);
        }

        $fileName = null;

        $jsonProject = json_encode($request->project);

        if ($request->hasFile('file')) {
            $file = $request->file;

            // Menentukan nama file dengan ekstensi yang sesuai
            $fileName = $request->nik . '.' . $file->getClientOriginalExtension();

            // Menyimpan file di direktori avatars dengan nama yang sudah ditentukan
            $file->storeAs('avatars', $fileName, 'public');

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
                'nationally'            => $request->nationally,
                'wfh'                   => $request->workStat
            ];
        } else {
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
                'nationally'            => $request->nationally,
                'wfh'                   => $request->workStat
            ];
        }

        Employes::where('id', $id)->update($data);

        if ($request->empStat == "Contract") {

            $annualID = Annualeave::where('employes_id', $id)->first();

            if ($annualID) {
                $dataAnnual = [
                    'totalAnnual'   => $months,
                    'nik'           => $request->nik
                ];

                $annualID->update($dataAnnual);
            }
        }

        if ($request->empStat == "Permanent") {
            return redirect()->route('employes.index')->with('danger', 'Please insert the amount of annual leave for this employee !!');
        }

        return redirect()->route('employes.index')->with('success', 'Data successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employes::find($id);

        if ($employee->active == true) {
            $employee->update(['active' => false]);
            Session::flash('danger', $employee->fullname() . ' deactived');
            return redirect()->route('employes.index');
        } else {
            $employee->update(['active' => true]);
            Session::flash('success', $employee->fullname() . ' actived');
            return redirect()->route('employes.index');
        }
    }
}

<?php

namespace App\Http\Controllers\Super_Administrator\Management_Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\HRD\Employes\StoreRequest;
use App\Http\Requests\Super_Administrator\Management_Role\CreateRequest;
use App\Http\Requests\Super_Administrator\Management_Role\StoreRequestt;
use App\Models\Department;
use App\Models\Employes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RoleAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('template_admin.super_admin.management_role.role_access.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //masukan data object
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestt $request)
    {
        $validated = $request->validated();

        if ($request->checkActived) {
            $checkActived = true;
        } else {
            $checkActived = false;
        }

        if ($request->checkOfficer) {
            $checkOfficer = true;
        } else {
            $checkOfficer = false;
        }

        if ($request->checkProduction) {
            $checkProduction = true;
        } else {
            $checkProduction = false;
        }

        if ($request->checkSPV) {
            $checkSPV = true;
        } else {
            $checkSPV = false;
        }

        if ($request->checkCoordinator) {
            $checkCoordinator = true;
        } else {
            $checkCoordinator = false;
        }

        if ($request->checkPM) {
            $checkPM = true;
        } else {
            $checkPM = false;
        }

        if ($request->checkProducer) {
            $checkProducer = true;
        } else {
            $checkProducer = false;
        }

        if ($request->checkHOD) {
            $checkHOD = true;
        } else {
            $checkHOD = false;
        }

        if ($request->checkGM) {
            $checkGM = true;
        } else {
            $checkGM = false;
        }

        if ($request->checkVerify) {
            $checkVerify = true;
        } else {
            $checkVerify = false;
        }

        if ($request->checkConfirmed) {
            $checkConfirmed = true;
        } else {
            $checkConfirmed = false;
        }

        if ($request->checkNeedSPV) {
            $checkNeedSPV = true;
        } else {
            $checkNeedSPV = false;
        }

        if ($request->checkNeedCoor) {
            $checkNeedCoor = true;
        } else {
            $checkNeedCoor = false;
        }

        if ($request->checkNeedPM) {
            $checkNeedPM = true;
        } else {
            $checkNeedPM = false;
        }

        if ($request->checkNeedProducer) {
            $checkNeedProducer = true;
        } else {
            $checkNeedProducer = false;
        }

        if ($request->checkNeedHOD) {
            $checkNeedHOD = true;
        } else {
            $checkNeedHOD = false;
        }

        if ($request->checkNeedGM) {
            $checkNeedGM = true;
        } else {
            $checkNeedGM = false;
        }

        if ($request->checkNeedVerify) {
            $checkNeedVerify = true;
        } else {
            $checkNeedVerify = false;
        }

        if ($request->checkNeedConfirmed) {
            $checkNeedConfirmed = true;
        } else {
            $checkNeedConfirmed = false;
        }

        $data = [
            'emp_id'    => $request->emp_id,
            'username'  => $request->username,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'active'    => $checkActived,
            'officer'       => $checkOfficer,
            'production'    => $checkProduction,
            'spv'           => $checkSPV,
            'coor'          => $checkCoordinator,
            'pm'            => $checkPM,
            'producer'      => $checkProducer,
            'hod'           => $checkHOD,
            'gm'            => $checkGM,
            'verify'        => $checkVerify,
            'confirmed'     => $checkConfirmed,
            'need_spv'      => $checkNeedSPV,
            'need_coor'     => $checkNeedCoor,
            'need_pm'       => $checkNeedPM,
            'need_producer' => $checkNeedProducer,
            'need_hod'      => $checkNeedHOD,
            'need_gm'       => $checkNeedGM,
            'need_verify'   => $checkNeedVerify,
            'need_hr_manager'    => $checkNeedConfirmed,
            'department_id' => $request->department
        ];

        User::create($data);
        $user = User::where('emp_id', $data['emp_id'])->first();

        if ($user) {
            // dd($data['emp_id'], $user);

            Employes::where('id', $data['emp_id'])->update(['user_id' => $user->id]);
        } else {
            Session::flash('danger', $data['name'] . " data cannot updated");
        }
        Session::flash('success', $data['name'] . ' account has been created');
        return redirect()->route('management-role-access.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employes::find($id);

        $departments = Department::orderBy('name', 'asc')->get();

        return view('template_admin.super_admin.management_role.role_access.show', compact(['employee', 'departments']));
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

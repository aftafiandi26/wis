<?php

namespace App\Http\Controllers\Super_Administrator\Management_Role;

use App\Http\Controllers\Controller;
use App\Models\Employes;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleDatatablesController extends Controller
{
    public function RoleAccess()
    {
        $query = Employes::where('active', true)->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function(Employes $employee) {
                return $employee->fullname();
            })
            ->addColumn('department', function(Employes $employee) {
                return $employee->department();
            })
            ->addColumn('spv', function(Employes $employee) {
                $return = '??';
                if ($employee->user_id) {
                    $query = User::find($employee->user_id);

                    if ($query->spv == true) {
                        $return = "Yes";
                    } else {
                        $return = "No";
                    }
                }
                return $return;
            })
            ->addColumn('coor', function(Employes $employee) {
                $return = '??';
                if ($employee->user_id) {
                    $query = User::find($employee->user_id);

                    if ($query->coor == true) {
                        $return = "Yes";
                    } else {
                        $return = "No";
                    }
                }
                return $return;
            })
            ->addColumn('pm', function(Employes $employee) {
                $return = '??';
                if ($employee->user_id) {
                    $query = User::find($employee->user_id);

                    if ($query->pm == true) {
                        $return = "Yes";
                    } else {
                        $return = "No";
                    }
                }
                return $return;
            })
            ->addColumn('producer', function(Employes $employee) {
                $return = '??';
                if ($employee->user_id) {
                    $query = User::find($employee->user_id);

                    if ($query->producer == true) {
                        $return = "Yes";
                    } else {
                        $return = "No";
                    }
                }
                return $return;
            })
            ->addColumn('hod', function(Employes $employee) {
                $return = '??';
                if ($employee->user_id) {
                    $query = User::find($employee->user_id);

                    if ($query->hod == true) {
                        $return = "Yes";
                    } else {
                        $return = "No";
                    }
                }
                return $return;
            })
            ->addColumn('gm', function(Employes $employee) {
                $return = '??';
                if ($employee->user_id) {
                    $query = User::find($employee->user_id);

                    if ($query->gm == true) {
                        $return = "Yes";
                    } else {
                        $return = "No";
                    }
                }
                return $return;
            })
            ->addColumn('verify', function(Employes $employee) {
                $return = '??';
                if ($employee->user_id) {
                    $query = User::find($employee->user_id);

                    if ($query->verify == true) {
                        $return = "Yes";
                    } else {
                        $return = "No";
                    }
                }
                return $return;
            })
            ->addColumn('confirmed', function(Employes $employee) {
                $return = '??';
                if ($employee->user_id) {
                    $query = User::find($employee->user_id);

                    if ($query->confirmed == true) {
                        $return = "Yes";
                    } else {
                        $return = "No";
                    }
                }
                return $return;
            })
            ->addColumn('actions', 'template_admin.super_admin.management_role.role_access.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}

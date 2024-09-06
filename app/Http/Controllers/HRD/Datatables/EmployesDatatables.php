<?php

namespace App\Http\Controllers\HRD\Datatables;

use App\Http\Controllers\Controller;
use App\Models\Employes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployesDatatables extends Controller
{
    public function data()
    {
        $query = Employes::where('active', true)->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function(Employes $emp){
                return $emp->fullname();
            })
            ->addColumn('depart_name', function(Employes $emp) {
                return $emp->department();
            })
            ->addColumn('actions', 'template_admin.hrd.employes.dashboard.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function deactiveData()
    {
        $query = Employes::where('active', false)->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function(Employes $emp){
                return $emp->fullname();
            })
            ->addColumn('depart_name', function(Employes $emp) {
                return $emp->department();
            })
            ->addColumn('actions', 'template_admin.hrd.employes.dashboard.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}

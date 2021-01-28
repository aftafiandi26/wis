<?php

namespace App\Http\Controllers\Admin\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\Models\Employes;

class DataCenter extends Controller
{
    public function Employes()
    {
      $model = Employes::with('department')->orderBy('first_name', 'asc')->get();

      return DataTables::of($model)
              ->addIndexColumn()
              ->addColumn('full_name', function(Employes $employee) {
                return $employee->first_name.' '.$employee->last_name;
              })
              ->editColumn('department_id', function(Employes $employee) {                
                return $employee->department->code_name;
              })
              ->editColumn('start_date', function(Employes $employee) {
                $join = Carbon::create($employee->start_date);
                return $join->toFormattedDateString();
              })
              ->editColumn('end_date', function(Employes $employee) {
                $end = Carbon::create($employee->end_date);
                return $end->toFormattedDateString();
              })
              ->editColumn('birthday', function(Employes $employee) {
                $birthday = Carbon::create($employee->birthday);
                return $birthday->toFormattedDateString();
              })
              ->editColumn('emp_active', function(Employes $employee) {
                if ($employee->emp_active == 0) {
                 return 'Deactived';
                } else {
                 return 'Actived';
                }
                
              })
              ->addColumn('action', 'admin.hrd.management.employee.action')
              ->rawColumns(['action'])
              ->toJson();
    }
}

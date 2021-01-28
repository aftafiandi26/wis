<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\User;
use App\Models\Access;
use App\Models\ModelRoles;
use App\Models\Role;
use App\Models\Employes;
use App\Models\Department;

class DataCenter extends Controller
{
    public function registrationUser()
    {
    	 $model = User::with(['roles', 'accesses'])->get();

      // $model->load('roles'); 
      // dd(auth()->user()->roles[0]['name']);
   		 return DataTables::of($model)
   		 		->addIndexColumn()
   		 		->addColumn('action', 'superAdmin.management_user.registration.action')          
          ->editColumn('roles', function(User $user) {
            return $user->roles[0]['name'];
          })
   		 		->editColumn('actived', function (User $user) {   		 			
   		 			if ($user->actived == 0) {
   		 				return 'Deactived';
   		 			}else{
   		 				return 'Actived';
   		 			}
   		 		})
   		 		->editColumn('access_id', function(User $user) {
   		 			if ($user->access_id == null) {
              return 'Need Access';
            } else {           
              return $user->accesses->accessing;
            }   	
   		 		})
          ->editColumn('department', function(User $user){
            if ($user->department_id == null) {
              return 'Admin';
            }else{
              return $user->department->code_name;
            }
          })
         	->rawColumns(['action', 'role'])
   		 		->toJson();
    }

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
              ->addColumn('action', 'superAdmin.management_user.employes.action')
              ->addColumn('actived', 'superAdmin.management_user.employes.active')
              ->rawColumns(['action', 'actived'])
              ->toJson();
    }
}

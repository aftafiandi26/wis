<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employes;


class ActionCenterController extends Controller
{
    public function employeStatus(Request $request, $id)
    {
    	$data = Employes::find($id);

    	if ($data->emp_active === 1) {
		    	$data->update([
		    		'emp_active' => 0,
		    	]);

		    	$msg = 'dinonaktifkan';    				
    		}
    	elseif ($data->emp_active === 0) {
		    	$data->update([
		    		'emp_active' => 1,
		    	]);
		    	$msg = 'diaktifkan';    				
    		}	

    	return redirect()->route('superAdmin.employee.index')
    	 ->with('success', $data->getFullName().' berhasil '.$msg.'!');
    }
}

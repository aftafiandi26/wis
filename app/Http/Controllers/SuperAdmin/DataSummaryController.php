<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employes;
use Carbon\Carbon;

class DataSummaryController extends Controller
{
    public function summaryEmployes()
    {
		$employes = Employes::where('emp_active', 1)->get();
		
		$totalEmployes = Employes::all();		

    	$now = Carbon::now();

		$employes->where('end_date', '<=', $now->addMonth());
		
		$percentEmployes = $employes->where('end_date', '<=', $now->addMonth())->count() * 100 / $totalEmployes->count();

    	// dd($percentEmployes);

    	return view('superAdmin.management_user.summary.index', [
			'employes' => $employes,
			'percentEmployes' => $percentEmployes
    	]);
    }
}

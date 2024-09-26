<?php

namespace App\Http\Controllers\HRD\Datatables;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HRD\Employes\CustomEmployesController;
use App\Models\Annualeave;
use App\Models\Employes;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AnnualeaveDatatablesController extends Controller
{
    public function dataAnnualofEmployes()
    {
        $query = Employes::where('active', true)->get();

        return DataTables::of($query)
            ->addColumn('fullname', function (Employes $employee) {
                return $employee->fullname();
            })
            ->addColumn('depart_name', function (Employes $employee) {
                return $employee->department();
            })
            ->addColumn('annual', function (Employes $emp) {
                $controller = new CustomEmployesController();
                $monthComming = $controller->monthComming($emp->join_contract);
                $annual = Annualeave::where('employes_id', $emp->id)->first();

                $result = 0;
                $supClass = "supClass1";

                if ($annual) {
                    $result = $annual->totalAnnual - $annual->takenAnnual - $monthComming;
                    $result = "+$result";
                    $supClass = "supClass2";
                }

                return "<b title='Availalbe'>$monthComming</b> <sup title='Remains' id='$supClass'>($result)</sup>";
            })
            ->addColumn('exdo', function (Employes $emp) {
                $annual = Annualeave::where('employes_id', $emp->id)->first();

                $result = 0;
                if ($annual) {
                    $result = $annual->totalExdo - $annual->takenExdo;
                }

                return $result;
            })
            ->addColumn('actions', 'template_admin.hrd.employes.annual.actions')
            ->rawColumns(['annual', 'actions'])
            ->toJson();
    }
}

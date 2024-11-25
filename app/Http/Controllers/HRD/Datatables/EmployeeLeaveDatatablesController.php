<?php

namespace App\Http\Controllers\HRD\Datatables;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HRD\Employes\CustomEmployesController;
use App\Models\Annualeave;
use App\Models\Employes;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeLeaveDatatablesController extends Controller
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

                if ($annual) {
                    $remainingAnnual = $annual->totalAnnual - $annual->takenAnnual - $monthComming;
                    $supClass = $remainingAnnual >= 0 ? "supClass2" : "supClass1";

                    // return "<b title='Available'>$monthComming</b> <sup title='Remains' class='$supClass'>(+$remainingAnnual)</sup>";
                    return $annual->annual;
                }

                return 0;
            })
            ->addColumn('exdo', function (Employes $emp) {
                $annual = Annualeave::where('employes_id', $emp->id)->first();

                $result = 0;
                if ($annual) {
                    $result = $annual->totalExdo - $annual->takenExdo;
                }

                return $result;
            })
            ->addColumn('actions', function(Employes $emp) {
                $id = $emp->id;
                $annual = Annualeave::where('employes_id', $id)->first();

                return view('template_admin.hrd.leave-management.annual.actions', compact(['id', 'annual']));
            })
            ->rawColumns(['annual', 'actions'])
            ->toJson();
    }
}

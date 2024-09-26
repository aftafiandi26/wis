<?php

namespace App\Http\Controllers\HRD\Datatables;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HRD\Employes\CustomEmployesController;
use App\Models\Annualeave;
use App\Models\Employes;
use App\Models\Exdoleave;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Empty_;

class EmployesDatatables extends Controller
{
    public function data()
    {
        $query = Employes::where('active', true)->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (Employes $emp) {
                return $emp->fullname();
            })
            ->addColumn('depart_name', function (Employes $emp) {
                return $emp->department();
            })
            ->addCOlumn('place_birth', function (Employes $emp) {
                return Str::title($emp->pob) . ', ' . $emp->bod;
            })
            ->addColumn('jenjang', function (Employes $emp) {
                return Str::title($emp->education) . ', ' . Str::title($emp->institution);
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
            ->editColumn('gender', function (Employes $emp) {
                return Str::title($emp->gender);
            })
            ->editColumn('alamat', function (Employes $emp) {
                return Str::title($emp->city) . ', ' . Str::title($emp->area) . ', ' . Str::title($emp->address);
            })
            ->editColumn('id_card', function (Employes $emp) {
                return "'$emp->id_card";
            })
            ->editColumn('kk', function (Employes $emp) {
                return "'$emp->kk";
            })
            ->editColumn('npwp', function (Employes $emp) {
                return "'$emp->npwp";
            })
            ->editColumn('religion', function (Employes $emp) {
                return Str::title($emp->religion);
            })
            ->editColumn('bpjs_kesehatan', function (Employes $emp) {
                return "'$emp->bpjs_kesehatan";
            })
            ->editColumn('bpjs_ketenagakerjaan', function (Employes $emp) {
                return "'$emp->bpjs_ketenagakerjaan";
            })
            ->addColumn('actions', 'template_admin.hrd.employes.dashboard.actions')
            ->rawColumns(['actions', 'annual'])
            ->toJson();
    }

    public function deactiveData()
    {
        $query = Employes::where('active', false)->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (Employes $emp) {
                return $emp->fullname();
            })
            ->addColumn('depart_name', function (Employes $emp) {
                return $emp->department();
            })
            ->addCOlumn('place_birth', function (Employes $emp) {
                return Str::title($emp->pob) . ', ' . $emp->bod;
            })
            ->addColumn('jenjang', function (Employes $emp) {
                return Str::title($emp->education) . ', ' . Str::title($emp->institution);
            })
            ->editColumn('gender', function (Employes $emp) {
                return Str::title($emp->gender);
            })
            ->editColumn('alamat', function (Employes $emp) {
                return Str::title($emp->city) . ', ' . Str::title($emp->area) . ', ' . Str::title($emp->address);
            })
            ->editColumn('id_card', function (Employes $emp) {
                return "'$emp->id_card";
            })
            ->editColumn('kk', function (Employes $emp) {
                return "'$emp->kk";
            })
            ->editColumn('bpjs_kesehatan', function (Employes $emp) {
                return "'$emp->bpjs_kesehatan";
            })
            ->editColumn('bpjs_ketenagakerjaan', function (Employes $emp) {
                return "'$emp->bpjs_ketenagakerjaan";
            })
            ->addColumn('actions', 'template_admin.hrd.employes.dashboard.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function endofContract()
    {
        $time = Carbon::now()->addMonths(2);

        $lowTimes = Carbon::now()->subMonths(3);

        $query = Employes::where('active', true)->whereDATE('end_contract', '>=', $lowTimes)->whereDATE('end_contract', '<=', $time)->get();



        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (Employes $emp) {
                return $emp->fullname();
            })
            ->addColumn('depart_name', function (Employes $emp) {
                return $emp->department();
            })
            ->addCOlumn('place_birth', function (Employes $emp) {
                return Str::title($emp->pob) . ', ' . $emp->bod;
            })
            ->addColumn('jenjang', function (Employes $emp) {
                return Str::title($emp->education) . ', ' . Str::title($emp->institution);
            })
            ->editColumn('gender', function (Employes $emp) {
                return Str::title($emp->gender);
            })
            ->editColumn('alamat', function (Employes $emp) {
                return Str::title($emp->city) . ', ' . Str::title($emp->area) . ', ' . Str::title($emp->address);
            })
            ->editColumn('id_card', function (Employes $emp) {
                return "'$emp->id_card";
            })
            ->editColumn('kk', function (Employes $emp) {
                return "'$emp->kk";
            })
            ->editColumn('bpjs_kesehatan', function (Employes $emp) {
                return "'$emp->bpjs_kesehatan";
            })
            ->editColumn('bpjs_ketenagakerjaan', function (Employes $emp) {
                return "'$emp->bpjs_ketenagakerjaan";
            })
            ->addColumn('actions', 'template_admin.hrd.employes.dashboard.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}

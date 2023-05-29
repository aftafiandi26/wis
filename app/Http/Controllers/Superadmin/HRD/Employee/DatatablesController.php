<?php

namespace App\Http\Controllers\Superadmin\HRD\Employee;

use App\Http\Controllers\Controller;
use App\Models\employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DatatablesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'session_counter', 'is_actived']);
    }

    public function superadminEmployes()
    {
        $data = employee::orderBy('first_name', 'asc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', 'superadmin.hrd.employes.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\Controller;
use App\Models\LeaveTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DatatablesApplyingLeaveController extends Controller
{
    public function formProgress()
    {
        $query = LeaveTransaction::where('ver_hrd', false)
            ->where('formStat', true)
            ->where('user_id', Auth::user()->id)
            ->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('leave_category_id', function (LeaveTransaction $transaction) {
                return $transaction->getLeaveCategory();
            })
            ->addColumn('status', function (LeaveTransaction $transaction) {
                $status = new CustomApplyingLeaveController();
                $status = $status->statusFormLeave($transaction);

                return $status;
            })
            ->addColumn('actions', 'template_admin.applying_leave.dashboard.modal-progress')
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function historyProgress()
    {
        $query = LeaveTransaction::whereNot('ver_hrd', false)
            ->where('formStat', true)
            ->where('user_id', Auth::user()->id)
            ->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('leave_category_id', function (LeaveTransaction $transaction) {
                return $transaction->getLeaveCategory();
            })
            ->addColumn('status', function (LeaveTransaction $transaction) {
                $status = new CustomApplyingLeaveController();
                $status = $status->statusFormLeave($transaction);

                return $status;
            })
            ->toJson();
    }
}

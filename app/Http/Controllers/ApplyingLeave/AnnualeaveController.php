<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\AnnualCountingController;
use App\Http\Controllers\Controller;
use App\Models\Annualeave;
use App\Models\Employes;
use App\Models\LeaveCategory;
use App\Models\LeaveTransaction;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AnnualeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Menyimpan cookie
    public function setCookie($data)
    {
        $encodedData = json_encode($data);

        // Simpan cookie "username" selama 7 hari
        Cookie::queue('cookieAnnual', $encodedData, 60); // 7 hari
    }

    // Membaca cookie
    public function getCookie($data)
    {
        $return = Cookie::get($data);
        return $return;
    }


    public function index()
    {
        $getCookie = $this->getCookie('cookieAnnual');

        $data = json_decode($getCookie, true);

        return view('template_admin.applying_leave.annual.form-applying-annual', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = Employes::with(['role_user', 'role_annual'])->where('user_id', Auth::user()->id)->first();

        $leaveCategory = LeaveCategory::find(1);

        $customApplying = new CustomApplyingLeaveController();

        $getProvinces = $customApplying->getProvinces();

        $getEmpHod = Employes::where('department_id', $employee->department_id)->get();

        $user_hod = $customApplying->user_hod();

        $user_coor = $customApplying->user_coor();
        $user_spv = $customApplying->user_spv();
        $user_pm = $customApplying->user_pm();
        $user_producer = $customApplying->user_producer();

        // dd($user_coor);

        $annualControler = new AnnualCountingController();

        $monthComming = $annualControler->monthComming($employee->join_contract);
        $monthComming = $monthComming - $employee->role_annual->takenAnnual;

        $month = 0;

        if ($employee->end_contract) {
            # code...
            $month = $annualControler->month($employee->join_contract, $employee->end_contract);
            $month = $month - $employee->role_annual->takenAnnual;
        }


        return view('template_admin.applying_leave.annual.index-contract', compact(['employee', 'getProvinces', 'user_hod', 'monthComming', 'user_coor', 'user_spv', 'user_pm', 'user_producer', 'leaveCategory']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = Employes::with(['role_annual'])->where('user_id', Auth::user()->id)->first();

        $roleLeave = new RoleLeaveController();

        $annualRoleLeave = $roleLeave->annual();

        if (empty($annualRoleLeave)) {
            Session::flash('danger', 'Please contact an administrator, there is something wrong with your role');
            return redirect()->route('applying-leave-annual.create');
        }

        if (empty($annualRoleLeave['hr_id']) or empty($annualRoleLeave['hrd_id'])) {
            Session::flash('danger', 'Please contact an administrator, there is something wrong with your role');
            return redirect()->route('applying-leave-annual.create');
        }

        if ($request->category == 1) {
            $array = [
                'entitlement'           => $employee->role_annual->totalAnnual,
                'pending'               => $employee->role_annual->annual,
                'taken'                 => $employee->role_annual->takenAnnual + $request->day,
                'remains'               => $employee->role_annual->annual - $request->day,
            ];
        }

        if ($request->category == 2) {
            $array = [
                'entitlement'           => $employee->role_annual->totalExdo,
                'pending'               => $employee->role_annual->exdo,
                'taken'                 => $employee->role_annual->takentakenExdoAnnual + $request->day,
                'remains'               => $employee->role_annual->exdo - $request->day,
            ];
        }

        if ($request->category >= 3) {
            $array = [
                'entitlement'           => 0,
                'pending'               => 0,
                'taken'                 => 0,
                'remains'               => 0,
            ];
        }

        $data = [
            'user_id'               => Auth::user()->id,
            'employee_id'           => $employee->id,
            'leave_category_Id'     => $request->category,
            'period'                => date('Y'),
            'start_leave'           => $request->startDate,
            'end_leave'             => $request->endDate,
            'back_work'             => $request->backWork,
            'total_day'             => $request->day,
            'entitlement'           => $array['entitlement'],
            'pending'               => $array['pending'],
            'taken'                 => $array['taken'],
            'remains'               => $array['remains'],
            'formStat'              => true,
            'spv_id'                => $request->spv,
            'ap_spv'                => $annualRoleLeave['ap_spv'],
            'date_spv'              => null,
            'coor_id'               => $request->coor,
            'ap_coor'               => $annualRoleLeave['ap_coor'],
            'date_coor'             => null,
            'pm_id'                 => $request->pm,
            'ap_pm'                 => $annualRoleLeave['ap_pm'],
            'date_pm'               => null,
            'producer_id'           => $request->producer,
            'ap_producer'           => $annualRoleLeave['ap_producer'],
            'date_producer'         => null,
            'hd_id'                 => $request->headof,
            'ap_hd'                 => $annualRoleLeave['ap_hd'],
            'date_hd'               => null,
            'hr_id'                 => $annualRoleLeave['hr_id'],
            'ver_hr'                => $annualRoleLeave['ver_hr'],
            'date_hrd'              => null,
            'hrd_id'                => $annualRoleLeave['hrd_id'],
            'ver_hrd'               => $annualRoleLeave['ver_hrd'],
            'date_hrd'              => null,
            'gm_id'                 => $request->gm_id,
            'ap_gm'                 => $annualRoleLeave['ap_gm'],
            'date_gm'               => null,
            'reason'                => $request->reason
        ];

        $getLeave = LeaveTransaction::where('user_id', Auth::user()->id)
            ->where(function ($query) use ($data) {
                $query->whereBetween('start_leave', [$data['start_leave'], $data['end_leave']])
                    ->orWhereBetween('end_leave', [$data['start_leave'], $data['end_leave']])
                    ->orWhere(function ($subQuery) use ($data) {
                        $subQuery->where('start_leave', '<=', $data['start_leave'])
                            ->where('end_leave', '>=', $data['end_leave']);
                    });
            })
            ->get();


        if ($getLeave->isNotEmpty()) {
            // Terdapat pengajuan cuti yang tumpang tindih dengan tanggal yang diajukan
            Session::flash('danger', 'You have already applied for leave on this date or there is an overlapping application.');
            Session::flash('info', 'Please check your applying form leave');
        } else {
            LeaveTransaction::create($data);

            if ($data['leave_category_Id'] == 1) {
                Annualeave::where('employes_id', $employee->id)->where('nik', $employee->nik)->update([
                    'annual'            => $employee->role_annual->annual - $data['total_day'],
                    'takenAnnual'       => $employee->role_annual->takenAnnual + $data['total_day']
                ]);
            }

            if ($data['leave_category_Id'] == 2) {
                Annualeave::where('employes_id', $employee->id)->where('nik', $employee->nik)->update([
                    'exdo'            => $employee->role_annual->exdo - $data['total_day'],
                    'takenExdo'       => $employee->role_annual->takenExdo + $data['total_day']
                ]);
            }

            Session::flash('success', 'Leave form successfully created');
        }

        return redirect()->route('applying-leave-dashboard.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $query = LeaveTransaction::with(['role_employee', 'role_user'])->where('id', $id)->firstOrFail();

        return view('template_admin.applying_leave.annual.show', compact(['query']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = LeaveTransaction::find($id);

        if (!$item) {
            Session::flash('danger', 'Data can not be found.');
            return redirect()->route('applying-leave-dashboard.index');
        }

        $annualeave = Annualeave::where('employes_id', $item->employee_id)->first();

        if (!$annualeave) {
            Session::flash('danger', 'Data can not be found.');
            return redirect()->route('applying-leave-dashboard.index');
        }

        $item->update(['formStat' => false]);

        if ($item->leave_category_id == 1) {
            $takenAnnual = $annualeave->takenAnnual - $item->total_day;
            $annual = $annualeave->annual + $item->total_day;

            $annualeave->update([
                'takenAnnual' => $takenAnnual,
                'annual'        => $annual
            ]);
            $item->delete();
        }

        if ($item->leave_category_id == 2) {
            $takenExdo = $annualeave->takenExdo - $item->total_day;
            $exdo = $annualeave->exdo + $item->total_day;

            $annualeave->update([
                'takenExdo' => $takenExdo,
                'exdo'      => $exdo
            ]);
            $item->delete();
        }

        if ($item->leave_category_id >= 3) {
            $item->delete();
        }

        Session::flash('success', 'Data has been deleted.');
        return redirect()->route('applying-leave-dashboard.index');
    }
}

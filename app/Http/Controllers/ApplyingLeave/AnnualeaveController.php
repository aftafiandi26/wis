<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\AnnualCountingController;
use App\Http\Controllers\Controller;
use App\Models\Employes;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class AnnualeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Menyimpan cookie
    public function setCookie()
    {
        // Simpan cookie "username" selama 7 hari
        Cookie::queue('username', 'JohnDoe', 60 * 24 * 7); // 7 hari
        return response('Cookie telah disimpan');
    }

    // Membaca cookie
    public function getCookie()
    {
        $username = Cookie::get('username');
        return response('Username di cookie adalah: ' . $username);
    }

    // Menghapus cookie
    public function deleteCookie()
    {
        // Hapus cookie "username"
        Cookie::queue(Cookie::forget('username'));
        return response('Cookie telah dihapus');
    }

    public function index()
    {
        $cookie = $this->setCookie();

        return $cookie;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = Employes::with('role_user')->where('user_id', Auth::user()->id)->first();


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

        $month = 0;

        if ($employee->end_contract) {
            # code...
            $month = $annualControler->month($employee->join_contract, $employee->end_contract);
        }


        return view('template_admin.applying_leave.annual.index-contract', compact(['employee', 'getProvinces', 'user_hod', 'monthComming', 'user_coor', 'user_spv', 'user_pm', 'user_producer']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = Employes::with(['role_annual'])->where('user_id', Auth::user()->id)->first();

        // $data = [
        //     'user_id'               => Auth::user()->id,
        //     'employee_id'           => $employee->id,
        //     'leave_category_Id'     => 1,
        //     'period'                => date('Y'),
        //     'start_leave'           => $request->startDate,
        //     'end_leave'             => $request->endDate,
        //     'back_work'             => $request->backWork,
        //     'total_day'             => $request->day,
        //     'entitlement'           => $employee->role_annual->totalAnnual,
        //     'pending'               => $employee->role_annual->annual,
        //     'taken'                 => $employee->role_annual->takenAnnual,
        //     'remains'               => $request->remains,
        //     'formStat'              => true,
        //     'spv_id'
        //     'ap_spv'
        //     'date_spv'
        //     'coor_id'
        //     'ap_coor'
        //     'date_coor'
        //     'pm_id'
        //     'ap_pm'
        //     'date_pm'
        //     'producer_id'
        //     'ap_producer'
        //     'date_producer'
        //     'hd_id'
        //     'ap_hd'
        //     'date_hd'
        //     'hrd_id'
        //     'ap_hrd'
        //     'date_hrd'
        //     'gm_id'
        //     'ap_gm'
        //     'date_gm'
        // ];

        // $json = json_decode($request->all());

        dd($request->all());

        return redirect()->route('applying-leave-annual.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}

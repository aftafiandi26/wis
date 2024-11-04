<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\AnnualCountingController;
use App\Http\Controllers\Controller;
use App\Models\Employes;
use App\Models\LeaveTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
use Spatie\Browsershot\Browsershot;

class ApplyingDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;

        $employee = Employes::with('role_annual')->where('user_id', $id)->first();

        if (empty($employee->role_annual)) {
            Session::flash('info', 'Your leave application page is not ready, please contact admininstrator.');
            return redirect()->route('dashboard');
        }

        $annualControler = new AnnualCountingController();

        $monthComming = $annualControler->monthComming($employee->join_contract);

        $monthComming = $monthComming - $employee->role_annual->takenAnnual;

        $month = 0;

        $adv = 0;

        if ($employee->end_contract) {
            # code...
            $month = $annualControler->month($employee->join_contract, $employee->end_contract);
            $month = $month - $employee->role_annual->takenAnnual;
            $adv = $month - $monthComming;
        }

        if ($employee->emp_status === "Permanent") {
            $month = $employee->role_annual->annual;
        }


        if (empty($employee->role_annual)) {
            return redirect()->back();
        }

        return view('template_admin.applying_leave.dashboard.index', compact(['employee', 'month', 'monthComming', 'adv']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $query = LeaveTransaction::with(['role_employee', 'role_user', 'role_leave_category'])->where('id', $id)->first();

        $titleName = Str::slug($query->first()->role_employee->fullname() . ' ' . $query->first()->role_leave_category->name);

        $iconic = Storage::url('public/logo_wis/kinema.png');

        $html = view('template_admin.applying_leave.dashboard.show-print', compact('query', 'titleName', 'iconic'))->render();

        $mpdf = new Mpdf();
        // $mpdf->SetProtection(array(), 'UserPassword', 'MyPassword');
        // $mpdf->SetWatermarkText('DRAFT');
        // $mpdf->showWatermarkText = true;

        $mpdf->SetHTMLFooter('
        <table width="100%">
            <tr>
                <td width="33%">{DATE j-m-Y}</td>
                <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right;">Wide Information System</td>
            </tr>
        </table>');

        $mpdf->WriteHTML($html);

        $mpdf->Output();
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

<?php

namespace App\Http\Controllers\HRD\Employes;

use App\Http\Controllers\Controller;
use App\Http\Requests\HRD\Employes\StoreAnnualRequest;
use App\Models\Annualeave;
use App\Models\Employes;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomEmployesController extends Controller
{    

    public function month($start, $end)
    {
        // Tanggal awal
        $startDate = new DateTime($start);

        // Tanggal akhir
        $endDate = new DateTime($end);

        // Menghitung selisih
        $interval = $startDate->diff($endDate);

        $increment = 0;

        if ($interval->d >= 28) {
            $increment = 1;
        }

        // Mendapatkan jumlah bulan
        $months = ($interval->y * 12) + $interval->m + $increment;

        return $months;
    }

    public function monthComming($start)
    {
        // Tanggal awal
        $startDate = new DateTime($start);

        // Tanggal akhir
        $endDate = new DateTime();

        // Menghitung selisih
        $interval = $startDate->diff($endDate);

        $increment = 0;

        if ($interval->d >= 28) {
            $increment = 1;
        }

        // Mendapatkan jumlah bulan
        $months = ($interval->y * 12) + $interval->m + $increment;

        return $months;
    }

    // API Sources

    public function activeEmployes()
    {
        return view('template_admin.hrd.employes.actived.active');
    }

    public function annualInput(string $id)
    {
        $employee = Employes::with('role_annual')->where('nik', $id)->where('active', true)->first();

        return view('template_admin.hrd.employes.actived.annualInputed', compact(['employee']));
    }

    public function postAnnualInput(StoreAnnualRequest $request, $id)
    {
        $validated = $request->validated();

        $annual = Annualeave::where('nik', $id)->first();

        $employee = Employes::where('nik', $id)->first();

        $data = [
            "totalAnnual" => $request->annual
        ];

        if ($annual) {            
            $annual->update($data);
            Session::flash('success', 'Annual updated !!');
        } else {
            Annualeave::create([
                'nik'           => $id,
                'employes_id'   => $employee->id,
                'totalAnnual'   => $request->annual
            ]);
            Session::flash('success', 'Annual created !!');
        }
        return redirect()->route('employes.index');
    }
}

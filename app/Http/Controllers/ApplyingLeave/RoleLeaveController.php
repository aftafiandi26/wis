<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleLeaveController extends Controller
{
    public function annual()
    {
        $ver_hr = User::with(['role_employes'])->where('active', true)->where('verify', true)->first();
        $ver_hr_manager = User::with(['role_employes'])->where('active', true)->where('confirmed', true)->first();

        $gm = null;
        if (!Auth::user()->need_gm) {
            $gm = User::with(['role_employes'])->where('active', true)->where('gm', true)->first();
            $gm = $gm->role_employes->id;
        }

        $data = [
            'ap_spv' => !Auth::user()->need_spv,   // Balikkan nilai spv
            'ap_coor' => !Auth::user()->need_coor,
            'ap_pm'    => !Auth::user()->need_pm,
            'ap_producer'  => !Auth::user()->need_producer,
            'ap_hd'        => !Auth::user()->need_hod,
            'ver_hr'        => !Auth::user()->need_verify,
            'ver_hrd'       => !Auth::user()->need_hr_manager,
            'ap_gm'         => !Auth::user()->need_gm,
            'hr_id'     => $ver_hr->role_employes->id ?? null,
            'hrd_id'    => $ver_hr_manager->role_employes->id ?? null,
            'gm_id'     => $gm,
        ];

        return $data;
    }
}

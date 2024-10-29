<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleLeaveController extends Controller
{
    public function annual()
    {
        $ver_hr = User::where('active', true)->where('admin', true)->where('verify', true)->first();
        $ver_hr_manager = User::where('active', true)->where('confitmed', true)->first();

        $gm = null;
        if (!Auth::user()->need_gm) {
            $gm = User::where('active', true)->where('gm', true)->first();
            $gm = $gm->id;
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
            'hr_id'     => $ver_hr->id,
            'hrd_id'    => $ver_hr_manager->id,
            'gm_id'     => $gm,
        ];

        return $data;
    }
}

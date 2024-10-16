<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleLeaveController extends Controller
{
    public function annual()
    {
        $data = null;

        if (Auth::user()->production == true) {

            // Staf Biasa
            if (Auth::user()->need_coor == true and Auth::user()->need_spv == true and Auth::user()->need_pm == true and Auth::user()->need_producer == true and Auth::user()->need_hod == true and Auth::user()->need_verify == true and Auth::user()->need_hr_manager == true and Auth::user()->need_gm == false) {
                $data = [
                    'ap_spv'        => false,
                    'ap_coor'       => false,
                    'ap_pm'         => false,
                    'ap_producer'   => false,
                    'ap_hd'         => false,
                    'ver_hr'        => false,
                    'ver_hrd'       => false,
                    'ap_gm'         => true,
                ];
            }
        }

        return $data;
    }
}

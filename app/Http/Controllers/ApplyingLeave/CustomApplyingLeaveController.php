<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomApplyingLeaveController extends Controller
{
    public function getProvinces()
    {
        $client = new Client();

        $response = $client->request('GET', 'https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');

        $data = json_decode($response->getBody()->getContents(), true);

        return $data;
    }

    public function getRegency($id)
    {
        $client = new Client();

        $response = $client->request('GET', 'https://emsifa.github.io/api-wilayah-indonesia/api/regencies/'.$id.'.json');

        $data = json_decode($response->getBody()->getContents(), true);

        return $data;
    }

    public function user_hod()
    {
        $result = null;

        if (Auth::user()->officer == true) {
            if (Auth::user()->hod == true) {
                $result = User::with('role_employes')->where('active', true)->where('gm', true)->get();

            } else {
                $result = User::with('role_employes')->where('department_id', Auth::user()->department_id)->where('active', true)->where('officer', Auth::user()->officer)->where('hod', true)->get();
            }
        }

        if (Auth::user()->production == true) {
            if (Auth::user()->hod == true) {
                $result = User::with('role_employes')->where('active', true)->where('gm', true)->get();

            } else {
                $result = User::with('role_employes')->where('department_id', Auth::user()->department_id)->where('active', true)->where('production', Auth::user()->production)->where('hod', true)->get();
            }
        }

        return $result;
    }

    public function user_coor()
    {
        $result = null;

        if (Auth::user()->production == true) {
            $result = User::with('role_employes')->where('production', true)->where('active', true)->where('department_id', Auth::user()->department_id)->where('coor', true)->get();
        }

        if (Auth::user()->officer == true) {
            $result = User::with('role_employes')->where('officer', true)->where('active', true)->where('department_id', Auth::user()->department_id)->where('coor', true)->get();
        }

        return $result;
    }

    public function user_spv()
    {
        $result = null;

        if (Auth::user()->production == true and Auth::user()->officer == false) {
            $result = User::with('role_employes')->where('production', true)->where('active', true)->where('department_id', Auth::user()->department_id)->where('spv', true)->get();
        }

        return $result;
    }

    public function user_pm()
    {
        $result = null;

        if (Auth::user()->production == true and Auth::user()->officer == false) {
            $result = User::with('role_employes')->where('production', true)->where('active', true)->where('department_id', Auth::user()->department_id)->where('pm', true)->get();
        }

        return $result;
    }

    public function user_producer()
    {
        $result = null;

        if (Auth::user()->production == true and Auth::user()->officer == false) {
            $result = User::with('role_employes')->where('production', true)->where('active', true)->where('department_id', Auth::user()->department_id)->where('producer', true)->get();
        }

        return $result;
    }

    public function statusFormLeave($transaction)
    {
        $return = "??";

        if (Auth::user()->need_spv == true) {
            if ($transaction->ap_spv == false and $transaction->ap_coor == false and $transaction->ap_pm == false and $transaction->ap_producer == false and $transaction->ap_hd == false and $transaction->ver_hr == false and $transaction->ver_hrd == false) {
                $return = "Waiting SPV";
            }
        }

        if (Auth::user()->need_coor == true) {
            if ($transaction->ap_spv == true and $transaction->ap_coor == false and $transaction->ap_pm == false and $transaction->ap_producer == false and $transaction->ap_hd == false and $transaction->ver_hr == false and $transaction->ver_hrd == false) {
                $return = "Waiting Coordinator";
            }
        }

        if (Auth::user()->need_pm == true) {
            if ($transaction->ap_spv == true and $transaction->ap_coor == true and $transaction->ap_pm == false and $transaction->ap_producer == false and $transaction->ap_hd == false and $transaction->ver_hr == false and $transaction->ver_hrd == false) {
                $return = "Waiting PM";
            }
        }

        if (Auth::user()->need_producer == true) {
            if ($transaction->ap_spv == true and $transaction->ap_coor == true and $transaction->ap_pm == true and $transaction->ap_producer == false and $transaction->ap_hd == false and $transaction->ver_hr == false and $transaction->ver_hrd == false) {
                $return = "Waiting Producer";
            }
        }

        if (Auth::user()->need_hod == true) {
            if ($transaction->ap_spv == true and $transaction->ap_coor == true and $transaction->ap_pm == true and $transaction->ap_producer == true and $transaction->ap_hd == false and $transaction->ver_hr == false and $transaction->ver_hrd == false) {
                $return = "Waiting Head of Department";
            }
        }

        if (Auth::user()->need_gm == true) {
            if ($transaction->ap_spv == true and $transaction->ap_coor == true and $transaction->ap_pm == true and $transaction->ap_producer == true and $transaction->ap_hd == true and $transaction->ap_gm == false and $transaction->ver_hr == false and $transaction->ver_hrd == false) {
                $return = "Waiting General Manager";
            }
        }

        if (Auth::user()->need_verify == true) {
            if ($transaction->ap_spv == true and $transaction->ap_coor == true and $transaction->ap_pm == true and $transaction->ap_producer == true and $transaction->ap_hd == true and $transaction->ap_gm == true and $transaction->ver_hr == false and $transaction->ver_hrd == false) {
                $return = "Waiting Verify HR";
            }
        }

        if (Auth::user()->need_hr_manager == true) {
            if ($transaction->ap_spv == true and $transaction->ap_coor == true and $transaction->ap_pm == true and $transaction->ap_producer == true and $transaction->ap_hd == true and $transaction->ap_gm == true and $transaction->ver_hr == true and $transaction->ver_hrd == false) {
                $return = "Waiting Confirmed HR";
            }
        }

        if ($transaction->ap_spv == true and $transaction->ap_coor == true and $transaction->ap_pm == true and $transaction->ap_producer == true and $transaction->ap_hd == true and $transaction->ap_gm == true and $transaction->ver_hr == true and $transaction->ver_hrd == true) {
            $return = "Success";
        }

        return $return;
    }

    public function modalProgressShowDelete($id)
    {
        return view('template_admin.applying_leave.dashboard.show-delete', compact('id'));
    }
}

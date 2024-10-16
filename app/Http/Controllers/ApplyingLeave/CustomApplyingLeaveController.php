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

        if (Auth::user()->officer == true and Auth::user()->production == false) {
            if (Auth::user()->hod == true) {
                $result = User::with('role_employes')->where('active', true)->where('gm', true)->get();

            } else {
                $result = User::with('role_employes')->where('department_id', Auth::user()->department_id)->where('active', true)->where('officer', Auth::user()->officer)->where('hod', true)->get();
            }
        }

        if (Auth::user()->officer == false and Auth::user()->production == true) {
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

        if (Auth::user()->production == true and Auth::user()->officer == false) {
            $result = User::with('role_employes')->where('production', true)->where('active', true)->where('department_id', Auth::user()->department_id)->where('coor', true)->get();
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
}

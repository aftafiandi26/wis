<?php

namespace App\Http\Controllers\ApplyingLeave;

use App\Http\Controllers\Controller;
use App\Models\Employes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AnnualeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getProvinces()
    {
        $response = file_get_contents('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
        $response = json_decode($response, true);

        return $response;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = Employes::where('user_id', Auth::user()->id)->first();

        $jsonProvince = json_encode('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');

        $getProvinces = $this->getProvinces();

        return view('template_admin.applying_leave.annual.index-contract', compact(['employee', 'getProvinces']));
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

<?php

namespace App\Http\Controllers\HRD\Employes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomEmployesController extends Controller
{
    public function activeEmployes()
    {
        return view('template_admin.hrd.employes.active');
    }
}

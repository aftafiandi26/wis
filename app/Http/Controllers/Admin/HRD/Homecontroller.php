<?php

namespace App\Http\Controllers\Admin\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{
   public function index()
   {
   		return view('admin.hrd.templates.default');
   }
}

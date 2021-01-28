<?php

namespace App\Http\Controllers\Admin\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Department;
use App\Models\Employes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hrd.management.employee.index', [
            'title' => 'Data Employee'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data_provinces = file_get_contents('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $provinces = json_decode($data_provinces, true);
        $provinces = $provinces['provinsi'];

        $projects = Project::orderBy('name', 'asc')->get();
        $departments = Department::orderBy('code_name', 'asc')->get();

        return view('admin.hrd.management.employee.create', [
            'title' => 'Create Data',
            'provinces' => $provinces,
            'projects'  => $projects,
            'departments' => $departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required|numeric|unique:employes,nik',
            'first_name' => 'required|min:3',
            'email' => 'required|email',
            'position' => 'required',
            'department' => 'required',
            'emp_status' => 'required',
            'start_date' => 'required|date',           
            'costAnnual' => 'numeric',
            'nationality' => 'required|min:4',
            'hometown'  => 'required|min:3',
            'birthday'  => 'required|date',
            'maiden_name' => 'required|min:3',
            'gender'    => 'required',
            'id_card'   => 'required|min:5|unique:employes,id_card',
            'phone'     => 'required|min:8',
            'address'   => 'required',
            'province'  => 'required',
            'town'      => 'required',
            'education' => 'required',
            'marital_status' => 'required',
            'npwp'  => 'required|numeric',
            'kk'    => 'required|numeric',
            'religion' => 'required',
            'project' => 'required',
            'photo' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kesehatan' => 'numeric',
            'ketenagakerjaan' => 'numeric',
        ]);

        $photo = null;

        if ($request->hasFile('photo')) { 
            $photo = Storage::putFile('public/assets/images/photo_profile', $request->file('photo'));
        }

        $mulai = $request->start_date;
        $akhir = $request->end_date;
       
        $hitung = date_diff(date_create($request->input('start_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%m')+(12*date_diff(date_create($request->input('start_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%y'));        
      
        $dataPermanent = [
            'nik' => $request->nik,
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'email'     => $request->email,
            'position'  => $request->position,
            'department_id' => $request->department,
            'emp_status' => $request->emp_status,
            'nationality' => $request->nationality,
            'start_date' => $mulai,
            'end_date'  => null,
            'birthday'  => $request->birthday,
            'hometown'  => $request->hometown,
            'gender'    => $request->gender,
            'id_card'   => $request->id_card,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'provinsi'  => $request->province,
            'town'      => $request->town,
            'education' => $request->education,
            'marital_status' =>$request->marital_status,
            'npwp' => $request->npwp,
            'kk'  => $request->kk,
            'religion' => $request->religion,
            'bpjs_ketenagakerjaan' => $request->ketenagakerjaan,
            'bpjs_kesehatan' => $request->kesehatan,
            'emp_active' => true,
            'annual' => 0,
            'total_annual' => $request->costAnnual,
            'project_id'   => $request->project,
            'photo'        => $photo,
            'maiden_name'  => $request->maiden_name,
            'created_by'   => auth()->user()->id
        ];

        $dataNonPermanent = [
            'nik' => $request->nik,
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'email'     => $request->email,
            'position'  => $request->position,
            'department_id' => $request->department,
            'emp_status' => $request->emp_status,
            'nationality' => $request->nationality,
            'start_date' => $mulai,
            'end_date'  => $akhir,
            'birthday'  => $request->birthday,
            'hometown'  => $request->hometown,
            'gender'    => $request->gender,
            'id_card'   => $request->id_card,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'provinsi'  => $request->province,
            'town'      => $request->town,
            'education' => $request->education,
            'marital_status' =>$request->marital_status,
            'npwp' => $request->npwp,
            'kk'  => $request->kk,
            'religion' => $request->religion,
            'bpjs_ketenagakerjaan' => $request->ketenagakerjaan,
            'bpjs_kesehatan' => $request->kesehatan,
            'emp_active' => true,
            'annual' => 0,
            'total_annual' => $hitung,
            'project_id'   => $request->project,
            'photo'        => $photo,
            'maiden_name'  => $request->maiden_name,
            'created_by'   => auth()->user()->id
        ];
       

        if ($request->emp_status === 'Permanent') {
             Employes::create($dataPermanent);
        }else {
             Employes::create($dataNonPermanent);
        }

        return redirect()->route('admin.hrd.employee.index')
                ->with('success', 'NIK '.$request->nik.' berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Employes::find($id);

        $data_provinces = file_get_contents('http://dev.farizdotid.com/api/daerahindonesia/provinsi/'.$data->provinsi.'');
        $provinces = json_decode($data_provinces, true);
        $provinces = $provinces['nama'];

        $start_date = Carbon::create($data->start_date);
        $end_date = Carbon::create($data->end_date);
        $birthday = Carbon::create($data->birthday);

        $remainsAnnual = $data->total_annual - $data->annual;

        $getPhoto = Storage::url($data->photo);

        if ($data->photo === null) {
            $getPhoto = 'http://via.placeholder.com/640x360';
        }
       

        $modal = '
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="showEmployesLabel">Detail Employee</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div>
                                <img src="'.$getPhoto.'" alt="photo profile" class="img-thumbnail img-circle" >
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="table-responsive">
                              <table class="table table-hover table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td class="text-bold">'.$data->nik.'</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td class="text-bold">'.$data->first_name.' '.$data->last_name.'</td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td>:</td>
                                            <td>'.$data->gender.'</td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td>:</td>
                                            <td>'.$data->position.'</td>
                                        </tr>
                                        <tr>
                                            <td>Employee Status</td>
                                            <td>:</td>
                                            <td>'.$data->emp_status.'</td>
                                        </tr>
                                        <tr>
                                            <td>Join Date</td>
                                            <td>:</td>
                                            <td>'.$start_date->toFormattedDateString().'</td>
                                        </tr>
                                        <tr>
                                            <td>End Date</td>
                                            <td>:</td>
                                            <td>'.$end_date->toFormattedDateString().'</td>
                                        </tr>
                                         <tr>
                                            <td>Exdo</td>
                                            <td>:</td>
                                            <td>'.$data->exdo.'</td>
                                        </tr>
                                        <tr>
                                            <td>Annual</td>
                                            <td>:</td>
                                            <td>'.$remainsAnnual.'</td>
                                        </tr>
                                        <tr>
                                            <td>Total Annual</td>
                                            <td>:</td>
                                            <td>'.$data->total_annual.'</td>
                                        </tr>
                                        <tr>
                                            <td>Birthday</td>
                                            <td>:</td>
                                            <td>'.$birthday->toFormattedDateString().'</td>
                                        </tr>
                                        <tr>
                                            <td>Nationality</td>
                                            <td>:</td>
                                            <td>'.$data->nationality.'</td>
                                        </tr>
                                        <tr>
                                            <td>Hometown</td>
                                            <td>:</td>
                                            <td>'.$data->hometown.'</td>
                                        </tr>
                                        <tr>
                                            <td>Maiden Name</td>
                                            <td>:</td>
                                            <td>'.$data->maiden_name.'</td>
                                        </tr>
                                        <tr>
                                            <td>ID Card (KTP)</td>
                                            <td>:</td>
                                            <td>'.$data->id_card.'</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td>'.$data->phone.'</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>:</td>
                                            <td>'.$data->address.'</td>
                                        </tr>
                                        <tr>
                                            <td>Province</td>
                                            <td>:</td>
                                            <td>'.$provinces.'</td>
                                        </tr>
                                        <tr>
                                            <td>Town</td>
                                            <td>:</td>
                                            <td>'.$data->town.'</td>
                                        </tr>
                                        <tr>
                                            <td>Education</td>
                                            <td>:</td>
                                            <td>'.$data->education.'</td>
                                        </tr>
                                        <tr>
                                            <td>Marital Status</td>
                                            <td>:</td>
                                            <td>'.$data->marital_status.'</td>
                                        </tr>
                                        <tr>
                                            <td>NPWP</td>
                                            <td>:</td>
                                            <td>'.$data->npwp.'</td>
                                        </tr>
                                        <tr>
                                            <td>KK</td>
                                            <td>:</td>
                                            <td>'.$data->kk.'</td>
                                        </tr>
                                        <tr>
                                            <td>Religion</td>
                                            <td>:</td>
                                            <td>'.$data->religion.'</td>
                                        </tr>
                                        <tr>
                                            <td>BPJS Ketenagakerjaan</td>
                                            <td>:</td>
                                            <td>'.$data->bpjs_ketenagakerjaan.'</td>
                                        </tr>
                                        <tr>
                                            <td>BPJS Kesehatan</td>
                                            <td>:</td>
                                            <td>'.$data->bpjs_kesehatan.'</td>
                                        </tr>
                                    </tbody>
                               </table>
                             </div>
                        </div>
                    </div>
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
       </div>';

        return $modal;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Employes::with(['department', 'project'])->find($id);
        $projects = Project::orderBy('name', 'asc')->get();
        $departments = Department::orderBy('code_name', 'asc')->get();

        $data_provinced = file_get_contents('https://dev.farizdotid.com/api/daerahindonesia/provinsi/'.$data->provinsi);
        $provinced = json_decode($data_provinced, true);  

        $data_provinces = file_get_contents('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $provinces = json_decode($data_provinces, true);
        $provinces = $provinces['provinsi'];    

        // dd(asset($data->photo));
        return view('admin.hrd.management.employee.edit', [
            'data' => $data,
            'projects' => $projects,
            'departments' => $departments, 
            'provinced'  => $provinced,
            'provinces'  => $provinces,
            'title'  => 'Edit Data '.$data->getFullName(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employes = Employes::find($id);
        $this->validate($request, [
            'nik' => 'required|numeric',
            'first_name' => 'required|min:3',
            'email' => 'email',
            'position' => 'required|string',
            'department' => 'required',
            'emp_status' => 'required',
            'start_date' => 'required|date',           
            'costAnnual' => 'numeric',
            'nationality' => 'required|string|min:4',
            'hometown'  => 'required|string|min:3',
            'birthday'  => 'required|date',
            'maiden_name' => 'required|string|min:3',
            'gender'    => 'required',
            'id_card'   => 'required|min:5',
            'phone'     => 'required|min:8',
            'address'   => 'required',
            'province'  => 'required',
            'town'      => 'required',
            'education' => 'required',
            'marital_status' => 'required',
            'npwp'  => 'required|numeric',
            'kk'    => 'required|numeric',
            'religion' => 'required',
            'project' => 'required',
            'photo' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kesehatan' => 'numeric',
            'ketenagakerjaan' => 'numeric',
        ]);

        $photo = null; 
        
        Storage::delete($employes->photo);
        if ($request->hasFile('photo')) {             
            $photo = Storage::putFile('public/assets/images/photo_profile', $request->file('photo'));

        }
        $mulai = $request->start_date;
        $akhir = $request->end_date;
       
        $hitung = date_diff(date_create($request->input('start_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%m')+(12*date_diff(date_create($request->input('start_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%y'));        
      
        $dataPermanent = [
            'nik' => $request->nik,
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'email'     => $request->email,
            'position'  => $request->position,
            'department_id' => $request->department,
            'emp_status' => $request->emp_status,
            'nationality' => $request->nationality,
            'start_date' => $mulai,
            'end_date'  => null,
            'birthday'  => $request->birthday,
            'hometown'  => $request->hometown,
            'gender'    => $request->gender,
            'id_card'   => $request->id_card,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'provinsi'  => $request->province,
            'town'      => $request->town,
            'education' => $request->education,
            'marital_status' =>$request->marital_status,
            'npwp' => $request->npwp,
            'kk'  => $request->kk,
            'religion' => $request->religion,
            'bpjs_ketenagakerjaan' => $request->ketenagakerjaan,
            'bpjs_kesehatan' => $request->kesehatan,
            'emp_active' => true,
            'annual' => $request->costAnnual,
            'total_annual' => $request->costAnnual,
            'project_id'   => $request->project,
            'photo'        => $photo,
            'maiden_name'  => $request->maiden_name,
            'created_by'   => auth()->user()->id
        ];

        $dataNonPermanent = [
            'nik' => $request->nik,
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'email'     => $request->email,
            'position'  => $request->position,
            'department_id' => $request->department,
            'emp_status' => $request->emp_status,
            'nationality' => $request->nationality,
            'start_date' => $mulai,
            'end_date'  => $akhir,
            'birthday'  => $request->birthday,
            'hometown'  => $request->hometown,
            'gender'    => $request->gender,
            'id_card'   => $request->id_card,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'provinsi'  => $request->province,
            'town'      => $request->town,
            'education' => $request->education,
            'marital_status' =>$request->marital_status,
            'npwp' => $request->npwp,
            'kk'  => $request->kk,
            'religion' => $request->religion,
            'bpjs_ketenagakerjaan' => $request->ketenagakerjaan,
            'bpjs_kesehatan' => $request->kesehatan,
            'emp_active' => true,
            'annual' => $hitung,
            'total_annual' => $hitung,
            'project_id'   => $request->project,
            'photo'        => $photo,
            'maiden_name'  => $request->maiden_name,
            'created_by'   => auth()->user()->id
        ]; 

        // dd($dataNonPermanent);

        if ($request->emp_status === 'Permanent') {
            $employes->update($dataPermanent);
        } else {
             $employes->update($dataNonPermanent);
        }

        return redirect()->route('admin.hrd.employee.index')
                ->with('info', 'Data berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employes = Employes::find($id);
        Storage::delete($employes->photo);
        $employes->delete();

        return redirect()->route('admin.hrd.employee.index')
                ->with('danger', 'Nik '.$employes->nik.' berhasil di hapus!');
    }
}

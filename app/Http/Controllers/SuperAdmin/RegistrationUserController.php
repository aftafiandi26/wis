<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Access;
use App\Models\Role;
use App\Models\ModelRoles;
use App\Models\Employes;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class RegistrationUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $model = User::with(['roles', 'accesses'])->get();     
        // dd($model);
        return view('superAdmin.management_user.registration.index', [
            'title' =>'Registration User'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employes::orderBy('first_name', 'asc')->get();
        $accesses = Access::all();
        $departments = Department::all();
        $roles = Role::all();

        return view('superAdmin.management_user.registration.create', [
            'employes' => $employes,
            'accesses' => $accesses,
            'roles'    => $roles, 
            'departments' => $departments,
            'title' =>'Create Registration User'
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
            'username' => 'required',
            'email'    => 'required|email|unique:users,email',
            'actived'  => 'required|numeric',
            'access'   => 'required',
            'roles'    => 'required'
            
        ]);

        $user = User::create([
            'username'      => $request->username,
            'employes_id'   => $request->employee,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'actived'       => $request->actived,
            'access_id'     => $request->access,
            'department_id' => $request->department
        ]);

        $user->assignRole($request->roles);

        return redirect()->route('superAdmin.user.index')->with('success', 'Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        if ($user->employee === null) {
           $modal = dd($user->employee);
        }
               
        $data_provinces = file_get_contents('https://dev.farizdotid.com/api/daerahindonesia/provinsi/'.$user->employee->provinsi.'');
        $provinces = json_decode($data_provinces, true);
        $provinces = $provinces['nama'];

        $start_date = Carbon::create($user->employee->start_date);
        $end_date = Carbon::create($user->employee->end_date);
        $birthday = Carbon::create($user->employee->birthday);

        $remainsAnnual = $user->employee->total_annual - $user->employee->annual;

        $getPhoto = Storage::url($user->employee->photo);

        if ($user->employee->photo === null) {
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
                                            <td class="text-bold">'.$user->employee->nik.'</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td class="text-bold">'.$user->employee->getFullName().'</td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td>:</td>
                                            <td>'.$user->employee->gender.'</td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td>:</td>
                                            <td>'.$user->employee->position.'</td>
                                        </tr>
                                        <tr>
                                            <td>Employee Status</td>
                                            <td>:</td>
                                            <td>'.$user->employee->emp_status.'</td>
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
                                            <td>Annual</td>
                                            <td>:</td>
                                            <td>'.$user->employee->annual.'</td>
                                        </tr>
                                        <tr>
                                            <td>Total Annual</td>
                                            <td>:</td>
                                            <td>'.$user->employee->total_annual.'</td>
                                        </tr>
                                        <tr>
                                            <td>Birthday</td>
                                            <td>:</td>
                                            <td>'.$birthday->toFormattedDateString().'</td>
                                        </tr>
                                        <tr>
                                            <td>Nationality</td>
                                            <td>:</td>
                                            <td>'.$user->employee->nationality.'</td>
                                        </tr>
                                        <tr>
                                            <td>Hometown</td>
                                            <td>:</td>
                                            <td>'.$user->employee->hometown.'</td>
                                        </tr>
                                        <tr>
                                            <td>Maiden Name</td>
                                            <td>:</td>
                                            <td>'.$user->employee->maiden_name.'</td>
                                        </tr>
                                        <tr>
                                            <td>ID Card (KTP)</td>
                                            <td>:</td>
                                            <td>'.$user->employee->id_card.'</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td>'.$user->employee->phone.'</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>:</td>
                                            <td>'.$user->employee->address.'</td>
                                        </tr>
                                        <tr>
                                            <td>Province</td>
                                            <td>:</td>
                                            <td>'.$provinces.'</td>
                                        </tr>
                                        <tr>
                                            <td>Town</td>
                                            <td>:</td>
                                            <td>'.$user->employee->town.'</td>
                                        </tr>
                                        <tr>
                                            <td>Education</td>
                                            <td>:</td>
                                            <td>'.$user->employee->education.'</td>
                                        </tr>
                                        <tr>
                                            <td>Marital Status</td>
                                            <td>:</td>
                                            <td>'.$user->employee->marital_status.'</td>
                                        </tr>
                                        <tr>
                                            <td>NPWP</td>
                                            <td>:</td>
                                            <td>'.$user->employee->npwp.'</td>
                                        </tr>
                                        <tr>
                                            <td>KK</td>
                                            <td>:</td>
                                            <td>'.$user->employee->kk.'</td>
                                        </tr>
                                        <tr>
                                            <td>Religion</td>
                                            <td>:</td>
                                            <td>'.$user->employee->religion.'</td>
                                        </tr>
                                        <tr>
                                            <td>BPJS Ketenagakerjaan</td>
                                            <td>:</td>
                                            <td>'.$user->employee->bpjs_ketenagakerjaan.'</td>
                                        </tr>
                                        <tr>
                                            <td>BPJS Kesehatan</td>
                                            <td>:</td>
                                            <td>'.$user->employee->bpjs_kesehatan.'</td>
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $accesses = Access::orderBy('accessing', 'asc')->get();
        $user->load('roles');
        $roles = Role::orderBy('name', 'asc')->get(); 
        $employes = Employes::orderBy('first_name', 'asc')->get();
        $departments = Department::all();
        
        // dd($user->employee->getFullName());

        return view('superAdmin.management_user.registration.edit', [
            'title' => 'Form edit',
            'user' => $user,
            "accesses" => $accesses,
            'roles' => $roles,
            'employes' => $employes,
            'departments' => $departments,
            'title' =>'Edit Registration User'
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'username' => 'required',
            'email'    => 'required|email',
            'actived'  => 'required|numeric',
            'access'   => 'required',
            'roles'    => 'required'
            
        ]);
        // dd($request->department);
       $modelRole =  ModelRoles::where('model_id', $user->id)->first();

        $user->update([
            'username'      => $request->username,
            'employes_id'   => $request->employee,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'actived'       => $request->actived,
            'access_id'     => $request->access,
            'department_id' => $request->department,
        ]);

        if ($modelRole == null) {
           $user->assignRole($request->roles);          
        }else{
           ModelRoles::where('model_id', $user->id)->delete();
           $user->assignRole($request->roles);
        }

       return redirect()->route('superAdmin.user.index')->with('success', 'Updated '. $user->username .' Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('superAdmin.user.index')->with('danger', 'Data has been Deleted !!');
    }
}

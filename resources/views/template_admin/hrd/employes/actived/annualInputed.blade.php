@extends('layouts.template_admin.layout')

@push('title')
    HRD - Employes Annual Leave
@endpush

@push('headling')
    Employee Annual Leave
@endpush

@push('subheadling')
    breacrumb
@endpush

@section('body')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <h4>Form Annual Employee</h4>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <button id="formSubmit" class="btn btn-sm btn-outline-success btn-round float-end">Save</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="#" method="post" class="needs-validation">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            placeholder="nik" value="{{ $employee->nik }}" name="nik" @readonly(true)>
                                        <label for="nik">NIK</label>
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control " placeholder="firstName"
                                            value="{{ $employee->first_name }}" @readonly(true)>
                                        <label for="firstName">First Name</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="lastName"
                                            value="{{ $employee->last_name }}" @readonly(true)>
                                        <label for="lastName">Last Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="position"
                                            value="{{ $employee->position }}" @readonly(true)>
                                        <label for="position">Potition</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="department"
                                            value="{{ $employee->department_id }}" @readonly(true)>
                                        <label for="department">Department</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="empStat"
                                            value="{{ $employee->emp_status }}"@readonly(true)>
                                        <label for="empStat">Emp. Stat</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="join_contract"
                                            value="{{ $employee->join_contract }}" @readonly(true)>
                                        <label for="join_contract">Join Contract</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="end_contract"
                                            value="{{ $employee->end_contract }}" @readonly(true)>
                                        <label for="end_contract">Department</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <form action="#" method="POST" action="#" id="formAnnual" class="needs-validation">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('annual') is-invalid @enderror"
                                            placeholder="annual" value="{{ $employee->role_annual->totalAnnual ?? old('annual') }}" name="annual">
                                        <label for="annual">Annual</label>
                                        @error('annual')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

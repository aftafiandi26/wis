@extends('layouts.template_admin.layout')

@push('title')
    HRD - Employes - Create
@endpush

@push('headling')
    Create
@endpush

@push('subheadling')
    {{ Breadcrumbs::render('hrd.employes.create') }}
@endpush

@push('style')
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/select2/select2-bootstrap-5-theme.min.css') }}"> --}}

    <style>
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        #formCreate input,
        #formCreate select {
            background-color: whitesmoke;
            font-weight: bold;
            /* Warna latar belakang seluruh div */
        }
    </style>
@endpush

@push('manageBtn')
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" id="manageDropdownList">
        <a class="dropdown-item" href="#">Active</a>
        <a class="dropdown-item" href="#">Deactive</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Chart</a>
    </ul>
@endpush

@section('body')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <h4>Form Employee</h4>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <button id="formSubmit" class="btn btn-sm btn-outline-success btn-round float-end">Save</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('employes.store') }}" method="post" id="formCreate" class="needs-validation">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        placeholder="nik" value="{{ old('nik') }}" name="nik">
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
                                    <input type="text" class="form-control @error('firstName') is-invalid @enderror"
                                        placeholder="first name" value="{{ old('firstName') }}" name="firstName">
                                    <label for="firstName">First Name</label>
                                    @error('firstName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                        placeholder="last name" value="{{ old('lastName') }}" name="lastName">
                                    <label for="lastName">Last Name</label>
                                    @error('lastName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('department') is-invalid @enderror" name="department">
                                        <option selected value="">Choose Department</option>
                                        @foreach ($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="select">choose departmet</label>
                                    @error('department')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('position') is-invalid @enderror"
                                        placeholder="Position" value="{{ old('position') }}" name="position">
                                    <label for="position">Position</label>
                                    @error('position')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('empStat') is-invalid @enderror" name="empStat">
                                        <option value="" selected>Open this status</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Permanent">Permanent</option>
                                        <option value="Intern">Intern</option>
                                    </select>
                                    <label for="select">Choose Emp Stat</label>
                                    @error('empStat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control @error('joinDate') is-invalid @enderror"
                                        placeholder="joinDate" value="{{ old('joinDate') }}" name="joinDate">
                                    <label for="joinDate">Joined</label>
                                    @error('joinDate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('pob') is-invalid @enderror"
                                        placeholder="pob" value="{{ old('pob') }}" name="pob">
                                    <label for="pob">Place of Birth</label>
                                    @error('pob')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control @error('bod') is-invalid @enderror"
                                        placeholder="bod" value="{{ old('bod') }}" name="bod">
                                    <label for="bod">Date of Birth</label>
                                    @error('bod')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                        <option value="" selected>Open this gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <label for="select">Choose Emp Stat</label>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control @error('endDate') is-invalid @enderror"
                                        placeholder="endDate" value="{{ old('endDate') }}" name="endDate">
                                    <label for="endDate">Ended</label>
                                    @error('endDate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('province') is-invalid @enderror"
                                        placeholder="province" value="{{ old('province') }}" name="province">
                                    <label for="province">Province</label>
                                    @error('province')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('maiden') is-invalid @enderror"
                                        placeholder="maiden" value="{{ old('maiden') }}" name="maiden">
                                    <label for="maiden">Maiden Name</label>
                                    @error('maiden')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('education') is-invalid @enderror"
                                        name="education">
                                        <option value="" selected>Open this Education</option>
                                        <option value="Elementary School">Elementary School</option>
                                        <option value="Junior High School">Junior High School</option>
                                        <option value="Senior High School">Senior High School</option>
                                        <option value="Bachelor">Bachelor's Degree</option>
                                        <option value="Master">Master's Degree</option>
                                        <option value="Doctor">Doctoral Degree</option>
                                    </select>
                                    <label for="select">Choose Emp Stat</label>
                                    @error('education')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('institution') is-invalid @enderror"
                                        placeholder="institution" value="{{ old('institution') }}" name="institution">
                                    <label for="institution">Institution</label>
                                    @error('institution')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('ktp') is-invalid @enderror"
                                        placeholder="ktp" value="{{ old('ktp') }}" name="ktp">
                                    <label for="ktp">ID Card</label>
                                    @error('ktp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('marital') is-invalid @enderror" name="marital">
                                        <option value="" selected>Open this status</option>
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="widowed">Widowed / Widower</option>
                                        <option value="divorced">Divorced / Divorcee</option>
                                    </select>
                                    <label for="select">Choose Marital Status</label>
                                    @error('marital')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('kk') is-invalid @enderror"
                                        placeholder="kk" value="{{ old('kk') }}" name="kk">
                                    <label for="kk">KK</label>
                                    @error('kk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('religion') is-invalid @enderror" name="religion">
                                        <option value="" selected>Open this status</option>
                                        <option value="islam">Islam</option>
                                        <option value="protestan">Protestan</option>
                                        <option value="khatolik">Khatolik</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="buddha">Buddha</option>
                                        <option value="konghucu">Konghucu</option>
                                    </select>
                                    <label for="select">Choose religion</label>
                                    @error('religion')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        placeholder="address" value="{{ old('address') }}" name="address">
                                    <label for="address">Address</label>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        placeholder="city" value="{{ old('city') }}" name="city">
                                    <label for="city">City</label>
                                    @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('area') is-invalid @enderror"
                                        placeholder="area" value="{{ old('area') }}" name="area">
                                    <label for="area">Area</label>
                                    @error('area')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('npwp') is-invalid @enderror"
                                        placeholder="npwp" value="{{ old('npwp') }}" name="npwp">
                                    <label for="npwp">NPWP</label>
                                    @error('npwp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text"
                                        class="form-control @error('ketenagakerjaan') is-invalid @enderror"
                                        placeholder="ketenagakerjaan" value="{{ old('ketenagakerjaan') }}"
                                        name="ketenagakerjaan">
                                    <label for="ketenagakerjaan">BPJS ketenagakerjaan</label>
                                    @error('ketenagakerjaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('kesehatan') is-invalid @enderror"
                                        placeholder="kesehatan" value="{{ old('kesehatan') }}" name="kesehatan">
                                    <label for="kesehatan">BPJS Kesehatan</label>
                                    @error('kesehatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('workStat') is-invalid @enderror" name="workStat">
                                        <option value="" selected>Open this status</option>
                                        <option value="WFH">Work From Hometown</option>
                                        <option value="WFS">Work from Studio</option>
                                        <option value="WFHB">Work From Hometown (Batam)</option>
                                    </select>
                                    <label for="select">Choose Work Status</label>
                                    @error('workStat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('nationally') is-invalid @enderror"
                                        placeholder="nationally" value="{{ old('nationally') }}" name="nationally">
                                    <label for="nationally">Nationally</label>
                                    @error('nationally')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <input type="file" class="form-file @error('file') is-invalid @enderror"
                                        placeholder="file" value="{{ old('file') }}" name="file">
                                    <label for="file">file</label>
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <br>
                                    <div id="fileouput">s</div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label for="project">Choose Project</label>
                                    <select class="form-select @error('project') is-invalid @enderror" name="project[]" multiple id="project" data-width="100%" >
                                        <option></option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('project')
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
@endsection

@push('script')
<script src="{{ asset('template/administrator/assets/js/plugin/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#formSubmit').on('click', function() {
                $('#formCreate').submit();
            });

            $("#project").select2({
                placeholder: 'Open projects',
                allowClear: true
            });
        });
    </script>
@endpush

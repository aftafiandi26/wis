@extends('layouts.template_admin.layout')

@push('title')
    HRD - Employes - Edit
@endpush

@push('headling')
    Create
@endpush

@push('subheadling')
    {{ Breadcrumbs::render('hrd.employes.edit', $employee) }}
@endpush

@push('style')
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

        img#previewImage {
            width: 300px;
            height: 200px;
        }

        input#imageInput {
            max-width: 100%;
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
                    <form action="{{ route('employes.update', $employee->id) }}" method="post" id="formCreate" class="needs-validation"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        placeholder="nik" value="{{ $employee->nik }}" name="nik">
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
                                        placeholder="first name" value="{{ $employee->first_name }}" name="firstName">
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
                                        placeholder="last name" value="{{ $employee->last_name }}" name="lastName">
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
                                        <option disabled>Open this choose departmet</option>
                                        @foreach ($departments as $dept)
                                            <option value="{{ $dept->id }}"
                                                @if ($employee->department_id === $dept->id) selected @endif>{{ $dept->name }}
                                            </option>
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
                                        placeholder="Position" value="{{ $employee->position }}" name="position">
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
                                        <option value="" disabled>Open this status</option>
                                        <option value="Contract" @if ($employee->emp_status == 'Contract') selected @endif>Contract
                                        </option>
                                        <option value="Permanent" @if ($employee->emp_status == 'Permanent') selected @endif>
                                            Permanent</option>
                                        <option value="Intern" @if ($employee->emp_status == 'Intern') selected @endif>>Intern
                                        </option>
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
                                        placeholder="joinDate" value="{{ $employee->join_contract }}" name="joinDate">
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
                                        placeholder="pob" value="{{ $employee->pob }}" name="pob">
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
                                        placeholder="bod" value="{{ $employee->bod }}" name="bod">
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
                                        <option value="" disable>Open this gender</option>
                                        <option value="Male" @if ($employee->gender === 'Male') selected @endif>Male
                                        </option>
                                        <option value="Female" @if ($employee->gender === 'Female') selected @endif>Female
                                        </option>
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
                                        placeholder="endDate" value="{{ $employee->end_contract }}" name="endDate">
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
                                        placeholder="province" value="{{ $employee->province }}" name="province">
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
                                        placeholder="maiden" value="{{ $employee->maiden }}" name="maiden">
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
                                        <option value="" disable>Open this Education</option>
                                        <option value="Elementary School"
                                            @if ($employee->education == 'Elementary School') selected @endif>Elementary School</option>
                                        <option value="Junior High School"
                                            @if ($employee->education == 'Junior High School') selected @endif>Junior High School</option>
                                        <option value="Senior High School"
                                            @if ($employee->education == 'Senior High School') selected @endif>Senior High School</option>
                                        <option value="Bachelor" @if ($employee->education == 'Bachelor') selected @endif>
                                            Bachelor's Degree</option>
                                        <option value="Master" @if ($employee->education == 'Master') selected @endif>Master's
                                            Degree</option>
                                        <option value="Doctor" @if ($employee->education == 'Doctor') selected @endif>Doctoral
                                            Degree</option>
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
                                        placeholder="institution" value="{{ $employee->institution }}"
                                        name="institution">
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
                                        placeholder="ktp" value="{{ $employee->id_card }}" name="ktp">
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
                                        <option value="" disabled>Open this status</option>
                                        <option value="single" @if ($employee->marital_status == 'single') selected @endif>Single
                                        </option>
                                        <option value="married" @if ($employee->marital_status == 'married') selected @endif>Married
                                        </option>
                                        <option value="widowed" @if ($employee->marital_status == 'widowed') selected @endif>Widowed
                                            / Widower</option>
                                        <option value="divorced" @if ($employee->marital_status == 'divorced') selected @endif>
                                            Divorced / Divorcee</option>
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
                                        placeholder="kk" value="{{ $employee->kk }}" name="kk">
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
                                        <option value="islam" @if ($employee->religion == 'islam') selected @endif>Islam
                                        </option>
                                        <option value="protestan" @if ($employee->religion == 'protestan') selected @endif>
                                            Protestan</option>
                                        <option value="khatolik" @if ($employee->religion == 'khatolik') selected @endif>
                                            Khatolik</option>
                                        <option value="hindu" @if ($employee->religion == 'hindu') selected @endif>Hindu
                                        </option>
                                        <option value="buddha" @if ($employee->religion == 'buddha') selected @endif>Buddha
                                        </option>
                                        <option value="konghucu" @if ($employee->religion == 'konghucu') selected @endif>
                                            Konghucu</option>
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
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('nationally') is-invalid @enderror"
                                        placeholder="nationally" value="{{ $employee->nationally }}" name="nationally">
                                    <label for="nationally">Nationally</label>
                                    @error('nationally')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        placeholder="address" value="{{ $employee->address }}" name="address">
                                    <label for="address">Address</label>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        placeholder="city" value="{{ $employee->city }}" name="city">
                                    <label for="city">City</label>
                                    @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('area') is-invalid @enderror"
                                        placeholder="area" value="{{ $employee->area }}" name="area">
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
                                        placeholder="npwp" value="{{ $employee->npwp }}" name="npwp">
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
                                        placeholder="ketenagakerjaan" value="{{ $employee->bpjs_ketenagakerjaan }}"
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
                                        placeholder="kesehatan" value="{{ $employee->bpjs_kesehatan }}"
                                        name="kesehatan">
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
                                        <option value="" disable>Open this status</option>
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
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <input type="file" class="form-file @error('file') is-invalid @enderror"
                                        placeholder="file" value="" name="file" id="imageInput">
                                    <label for="file">file</label>
                                    <br>
                                    <small>max: 5MB | Format:PNG, JPEG, JPG</small>
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <br>
                                    <img src="{{ $noImg }}" alt="not-available" id="previewImage"
                                        class="img img-circle img-thumbnail">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label for="project">Choose Project</label>                                    
                                    <select class="form-select @error('project') is-invalid @enderror" name="project[]" multiple id="project" data-width="100%">                                     
                                        @foreach ($projects as $key => $project)
                                            <option value="{{ $project->id }}" @selected(in_array($project->id, $projectID ?? []))>{{ $project->name }}</option>
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
    <script src="{{ asset('template/administrator/assets/js/plugin/select2/select2.full.min.js') }}" defer></script>
    <script src="{{ asset('template/administrator/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}" defer>
    </script>
    <script>
        $(document).ready(function() {
            $('#formSubmit').on('click', function() {
                $('#formCreate').submit();
            });

            $("#project").select2({
                placeholder: 'Open projects',
                allowClear: true,
                width: '100%'
            });

            document.getElementById('imageInput').addEventListener('change', function(event) {
                // Mendapatkan file yang dipilih oleh pengguna
                let file = event.target.files[0];

                // Pastikan file adalah gambar
                if (file && file.type.startsWith('image/')) {
                    // Membuat FileReader untuk membaca file
                    let reader = new FileReader();


                    // Event listener untuk ketika FileReader selesai membaca file
                    reader.onload = function(e) {
                        // Mengatur sumber (src) elemen gambar dengan data yang dibaca oleh FileReader
                        let img = document.getElementById('previewImage');
                        img.src = e.target.result;
                        img.style.display = 'block'; // Tampilkan gambar
                    };
                    // Membaca file sebagai Data URL (base64)
                    reader.readAsDataURL(file);
                } else {

                    $.notify({
                        // options
                        message: 'Please select a valid image file.',
                        title: 'Image Error',
                        icon: 'icon-bell'
                    }, {
                        // settings
                        type: 'danger',
                        allow_dismiss: false,
                    });
                }
            });
        });
    </script>
@endpush

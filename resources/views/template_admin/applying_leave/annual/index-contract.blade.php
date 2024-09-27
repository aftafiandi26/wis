@extends('layouts.template_admin.layout')

@push('title')
    Applying Leave - Annual
@endpush

@push('headling')
    Annual
@endpush

@push('subheadling')
    {{ Breadcrumbs::render('applying-leave.annual') }}
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
            color: black;
            /* Warna latar belakang seluruh div */
        }

        .fa-exclamation-circle {
            color: red;
        }

        label {}
    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <h4>Annual Form</h4>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <button id="formSubmit" class="btn btn-sm btn-outline-success btn-round float-end">Save</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="formCreate" class="needs-validation">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $employee->fullname() }}" readonly>
                                    <label for="request_by">Request By</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $employee->nik }}" readonly>
                                    <label for="nik">nik</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4"></div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control @error('start') is-invalid @enderror">
                                    <label for="start">Start Date <i class="fas fa-exclamation-circle"></i></label>
                                    @error('start')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control @error('end') is-invalid @enderror">
                                    <label for="end">End Date <i class="fas fa-exclamation-circle"></i></label>
                                    @error('end')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ date('Y') }}" readonly>
                                    <label for="period">Period</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $employee->position }}" readonly>
                                    <label for="position">Position</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4"></div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control @error('backWork') is-invalid @enderror"
                                        name="backWork" placeholder="{{ date('Y-m-d') }}">
                                    <label for="backWork">Back to Work at <i class="fas fa-exclamation-circle"></i></label>
                                    @error('backWork')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('day') is-invalid @enderror"
                                        name="day" value="0" readonly>
                                    <label for="day">Day<i class="fas fa-exclamation-circle"></i></label>
                                    @error('day')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $employee->join_contract }}"
                                        readonly>
                                    <label for="joined">Join of Contract</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $employee->end_contract }}"
                                        readonly>
                                    <label for="ended">End of Contract</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4"></div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('category') is-invalid @enderror"
                                        name="category" value="Annual" readonly>
                                    <label for="category">Leave Category <i class="fas fa-exclamation-circle"></i></label>
                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('balance') is-invalid @enderror"
                                        name="balance" value="0" readonly>
                                    <label for="balance">Balance <i class="fas fa-exclamation-circle"></i></label>
                                    @error('balance')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="email" readonly>
                                    <label for="joined">Email</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $employee->department() }}"
                                        readonly>
                                    <label for="ended">Department</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4"></div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <div class="row">
                                        <label for="province">Province of Destination
                                            <i class="fas fa-exclamation-circle"></i></label>
                                    </div>
                                    <div class="row">
                                        <select name="province" id="province"
                                            class="form-select @error('province') is-invalid @enderror" data-width="100%">
                                            <option value=""></option>
                                            @foreach ($getProvinces as $province)
                                                <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        @error('province')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <div class="form-floating mb-3">
                                    <select name="destination" id="destination"
                                        class="form-control @error('destination') is-invalid @enderror">
                                        <option value="">1</option>
                                        <option value="">1</option>
                                        <option value="">1</option>
                                        <option value="">1</option>
                                    </select>
                                    <label for="balance">City of Destination <i
                                            class="fas fa-exclamation-circle"></i></label>
                                    @error('balance')
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

    <script>
        $(document).ready(function() {
            $("#province").select2({
                placeholder: 'Open projects',
                width: '100%'
            });
        });
    </script>
@endpush

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
                    <form action="{{ route('applying-leave-annual.store') }}" method="post" id="formCreate" class="needs-validation">
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
                                    <input type="date" class="form-control @error('start') is-invalid @enderror"
                                        id="startDate" name="startDate">
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
                                    <input type="date" class="form-control @error('end') is-invalid @enderror"
                                        id="endDate" name="endDate" readonly>
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
                                        name="backWork" placeholder="{{ date('Y-m-d') }}" readonly id="backWork">
                                    <label for="backWork">Back to Work at <i class="fas fa-exclamation-circle"></i></label>
                                    @error('backWork')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('day') is-invalid @enderror"
                                        name="day" value="0" readonly id="day">
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
                            <div class="col-sm-2 col-md-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('balance') is-invalid @enderror"
                                        name="balance" value="{{ $monthComming }}" readonly id="balance">
                                    <label for="balance">Balance <i class="fas fa-exclamation-circle"></i></label>
                                    @error('balance')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('remains') is-invalid @enderror"
                                        name="remains" value="{{ $monthComming }}" readonly id="remains">
                                    <label for="remains">Remains <i class="fas fa-exclamation-circle"></i></label>
                                    @error('remains')
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
                                    <div class="row">
                                        <label for="province">Cities of Destination
                                            <i class="fas fa-exclamation-circle"></i></label>
                                    </div>
                                    <div class="row">
                                        <select name="cities" id="cities"
                                            class="form-select @error('cities') is-invalid @enderror" data-width="100%">
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
                        </div>

                        {{-- // control approval --}}

                        @if (auth()->user()->officer == true)
                            @include('template_admin.applying_leave.form-approval.officer')
                        @endif
                        @if (auth()->user()->production == true)
                            @include('template_admin.applying_leave.form-approval.production-staff')
                        @endif

                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-floating mb-3">
                                    <textarea name="reason" id="reason" cols="10" rows="5" class="form-control"></textarea>
                                    <label for="reason">Reason <i class="fas fa-exclamation-circle"></i></label>
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

@push('script')
    <script src="{{ asset('template/administrator/assets/js/plugin/select2/select2.full.min.js') }}" defer></script>
    <script src="{{ asset('template/administrator/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}" defer>
    </script>

    <script>
        $(document).ready(function() {

            function showNotification(type, message, from, align, icon) {
                $.notify({
                    title: 'Employee Status',
                    message: message,
                    icon: icon,
                }, {
                    type: type,
                    placement: {
                        from: from,
                        align: align
                    },
                    timer: 1000,
                });
            }

            function showAlertCitiesFailed(type, message, from, align, icon, title) {
                $.notify({
                    title: title,
                    message: message,
                    icon: icon,
                }, {
                    type: type,
                    placement: {
                        from: from,
                        align: align
                    },
                    timer: 1000,
                });
            }

            function calculateBusinessDays(startDate, endDate) {
                let start = new Date(startDate);
                let end = new Date(endDate);
                let count = 0;

                // Loop melalui setiap hari antara startDate dan endDate
                while (start <= end) {
                    let dayOfWeek = start.getDay(); // Mendapatkan hari dalam minggu (0 = Minggu, 6 = Sabtu)

                    // Hitung hanya jika hari antara Senin (1) dan Jumat (5)
                    if (dayOfWeek !== 0 && dayOfWeek !== 6) {
                        count++;
                    }

                    // Pindah ke hari berikutnya
                    start.setDate(start.getDate() + 1);
                }

                return count;
            }

            // Cek apakah ada session success
            @if (session('danger'))
                showNotification('danger', '{{ session('danger') }}', 'top', 'right', 'fas fa-user-alt-slash');
            @endif

            // Cek apakah ada session danger
            @if (session('success'))
                showNotification('success', '{{ session('success') }}', 'top', 'right', 'fas fa-user');
            @endif

            $("select#province").select2({
                placeholder: 'Open province',
                width: '100%'
            });

            $("select#cities").select2({
                placeholder: 'Open cities',
                width: '100%'
            });

            $("select#headof").select2({
                placeholder: 'Choose approval',
                width: '100%'
            });

            $("select#coor").select2({
                placeholder: 'Choose approval',
                width: '100%'
            });

            $("select#spv").select2({
                placeholder: 'Choose approval',
                width: '100%'
            });

            $("select#pm").select2({
                placeholder: 'Choose approval',
                width: '100%'
            });

            $("select#producer").select2({
                placeholder: 'Choose approval',
                width: '100%'
            });

            $("select#gm").select2({
                placeholder: 'Choose approval',
                width: '100%'
            });

            $('#province').on('change', function() {
                $('#cities').html('');

                let provinceId = $('#province').val(); // Mengambil ID provinsi yang dipilih
                let url = "{{ route('applying-leave-annual-regency', ':provinceId') }}";
                url = url.replace(':provinceId', provinceId);

                $.ajax({
                    url: url,
                    dataType: 'json',
                    method: 'GET',
                    success: function(result) {
                        // console.log(result);
                        //
                        $.each(result, function(index, item) {

                            $('#cities').append(`<option value="` + item.name + `">` +
                                item.name + `</option>`);
                        })
                    },
                    error: function(xhr, status, error) {
                        showAlertCitiesFailed('danger', 'Cities of destination cannot open',
                            'top', 'right', 'fas fa-bell-slash', 'Data Failure !!');
                    }
                });
            });

            $('input#startDate').on('change', function() {
                let startDate = $(this).val();
                let endDate = $('input#endDate').val();
                $('input#endDate').removeAttr('readonly');
                let balance = $('input#balance').val();
                document.getElementById('endDate').value = '';
                document.getElementById('backWork').value = '';

                if (!endDate) {
                    showAlertCitiesFailed('danger', 'Please insert "End Date"',
                        'top', 'right', 'fas fa-calendar-minus', 'End Date Empty');
                }
                if (endDate) {
                    let businessDays = calculateBusinessDays(startDate, endDate);
                    document.getElementById('day').value = businessDays;
                    // document.getElementById('remains').value = balance - businessDays;
                }

                if (startDate > endDate) {

                }

            });

            $('input#endDate').on('change', function() {
                let endDate = $(this).val();
                let startDate = $('input#startDate').val();
                let balance = $('input#balance').val();

                if (!startDate) {
                    showAlertCitiesFailed('danger', 'Please insert "Start Date"',
                        'top', 'right', 'fas fa-calendar-minus', 'Start Date Empty');
                }

                if (endDate < startDate) {
                    showAlertCitiesFailed('danger', 'Sorry, Your leave date cannot balance',
                        'top', 'right', 'fas fa-calendar-minus', 'Date Failure!!');
                } else {
                    $('input#backWork').removeAttr('readonly');
                    let businessDays = calculateBusinessDays(startDate, endDate);
                    document.getElementById('remains').value = balance - businessDays;
                    document.getElementById('day').value = businessDays;
                }
            });

            $('input#backWork').on('change', function() {
                let backWork = $(this).val();
                let startDate = $('input#startDate').val();
                let endDate = $('input#endDate').val();
                let balance = $('input#balance').val();

                if (backWork < endDate) {
                    showAlertCitiesFailed('danger', 'Sorry, Your leave date cannot balance',
                        'top', 'right', 'fas fa-calendar-minus', 'Date Failure!!');
                }

                if (backWork == endDate) {
                    let businessDays = calculateBusinessDays(startDate, endDate);
                    let counting = businessDays - 0.5;
                    document.getElementById('day').value = counting;
                    document.getElementById('remains').value = balance - counting;

                }

                if (backWork > endDate) {
                    let businessDays = calculateBusinessDays(startDate, endDate);
                    document.getElementById('day').value = businessDays;
                    document.getElementById('remains').value = balance - businessDays;
                }
            });
            $("button#formSubmit").on('click', function(e) {
                $('#formCreate').submit();
            })

        });
    </script>
@endpush

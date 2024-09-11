@extends('layouts.template_admin.layout')

@push('title')
    HRD - Employes
@endpush

@push('headling')
    Dashboard
@endpush

@push('subheadling')
    {{ Breadcrumbs::render('hrd.employes') }}
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('build/assets/apexcharts/dist/apexcharts.css') }}">
    <link href="{{ asset('build/assets/datatables/partials/bs.datatables.min.css') }}" rel="stylesheet">
    <style>
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            /* Bayangan saat hover */
        }

        .card-header span {
            font-weight: bold;
        }
    </style>
@endpush

@push('manageBtn')
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" id="manageDropdownList">
        <a class="dropdown-item" href="{{ route('employes.create') }}">Add Employee</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('employes.actived') }}">Active</a>
        <a class="dropdown-item" href="#">Deactive</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Chart</a>
    </ul>
@endpush


@section('body')
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round" id="cardEmployes" data-bs-role="{{ route('employes.actived') }}">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Employes</p>
                                <h4 class="card-title">{{ $employes->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Permanent</p>
                                <h4 class="card-title">{{ $employes->where('emp_status', 'Permanent')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-luggage-cart"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Contract</p>
                                <h4 class="card-title">{{ $employes->where('emp_status', 'Contract')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Intern</p>
                                <h4 class="card-title">{{ $employes->where('emp_status', 'Intern')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>List Employes Active</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-hover table-condensed table-borderless table-striped"
                            id="tables">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>NIK</th>
                                    <th>Employes</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>List Employes Deactive</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-hover table-condensed table-borderless table-striped"
                            id="tablesDeactive">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>NIK</th>
                                    <th>Employes</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('build/assets/apexcharts/dist/apexcharts.js') }}" defer></script>
    <script src="{{ asset('build/assets/datatables/partials/bs.datatables.min.js') }}" defer></script>
    <script src="{{ asset('build/assets/datatables/partials/pdfmake.min.js') }}" defer></script>
    <script src="{{ asset('build/assets/datatables/partials/vfs_fonts.js') }}" defer></script>
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

            // Cek apakah ada session success
            @if (session('danger'))
                showNotification('danger', '{{ session('danger') }}', 'top', 'right', 'fas fa-user-alt-slash');
            @endif

            // Cek apakah ada session danger
            @if (session('success'))
                showNotification('success', '{{ session('success') }}', 'top', 'right', 'fas fa-user');
            @endif

        });
    </script>


    <script>
        $(document).ready(function() {

            var e = $(".sidebar .scrollbar");

            var options = {
                series: [{
                    name: 'Contract',
                    data: [
                        {{ $employes->where('department_id', 1)->where('emp_status', 'Contract')->count() }},
                        {{ $employes->where('department_id', 2)->where('emp_status', 'Contract')->count() }},
                        {{ $employes->where('department_id', 3)->where('emp_status', 'Contract')->count() }},
                        {{ $employes->where('department_id', 4)->where('emp_status', 'Contract')->count() }},
                        {{ $employes->where('department_id', 5)->where('emp_status', 'Contract')->count() }},
                        {{ $employes->where('department_id', 6)->where('emp_status', 'Contract')->count() }},
                        {{ $employes->where('department_id', 7)->where('emp_status', 'Contract')->count() }},
                    ]
                }, {
                    name: 'Permanent',
                    data: [
                        {{ $employes->where('department_id', 1)->where('emp_status', 'Permanent')->count() }},
                        {{ $employes->where('department_id', 2)->where('emp_status', 'Permanent')->count() }},
                        {{ $employes->where('department_id', 3)->where('emp_status', 'Permanent')->count() }},
                        {{ $employes->where('department_id', 4)->where('emp_status', 'Permanent')->count() }},
                        {{ $employes->where('department_id', 5)->where('emp_status', 'Permanent')->count() }},
                        {{ $employes->where('department_id', 6)->where('emp_status', 'Permanent')->count() }},
                        {{ $employes->where('department_id', 7)->where('emp_status', 'Permanent')->count() }},
                    ]
                }, {
                    name: 'Intern',
                    data: [
                        {{ $employes->where('department_id', 1)->where('emp_status', 'Intern')->count() }},
                        {{ $employes->where('department_id', 2)->where('emp_status', 'Intern')->count() }},
                        {{ $employes->where('department_id', 3)->where('emp_status', 'Intern')->count() }},
                        {{ $employes->where('department_id', 4)->where('emp_status', 'Intern')->count() }},
                        {{ $employes->where('department_id', 5)->where('emp_status', 'Intern')->count() }},
                        {{ $employes->where('department_id', 6)->where('emp_status', 'Intern')->count() }},
                        {{ $employes->where('department_id', 7)->where('emp_status', 'Intern')->count() }},
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        dataLabels: {
                            total: {
                                enabled: true,
                                offsetX: 0,
                                style: {
                                    fontSize: '13px',
                                    fontWeight: 900
                                }
                            }
                        }
                    },
                },
                stroke: {
                    width: 1,
                    colors: ['#fff']
                },
                title: {
                    text: 'Employes Chart'
                },
                xaxis: {
                    categories: ['IT', 'HR', 'FA', 'Facility',
                        'Operation', 'Prod - Animation', 'Prod - Live Shoot'
                    ],
                    labels: {
                        formatter: function(val) {
                            return val + " People"
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: undefined
                    },
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + "K"
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'left',
                    offsetX: 40
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();

            $('table#tables').DataTable({
                "procesisng": true,
                "responsive": false,
                "ajax": {
                    "url": "{{ route('employes.data') }}",
                    "contentType": 'application/json',
                    "type": 'GET',
                    "data": function(d) {
                        return JSON.stringify(d);
                    }
                },
                "columns": [{
                        "data": "actions",
                        "orderable": false,
                        "searchable": false
                    },
                    {
                        "data": "nik"
                    },
                    {
                        "data": "fullname"
                    },
                    {
                        "data": "position"
                    },
                    {
                        "data": "depart_name"
                    },
                    {
                        "data": "join_contract"
                    },
                    {
                        "data": "end_contract"
                    }
                ],
                "pageLength": 5,
                "language": {
                    "entries": {
                        _: 'peoples',
                        1: 'person'
                    }
                },
                "layout": {
                    "topStart": {
                        "pageLength": {
                            "menu": [5, 10, 25, 50]
                        },
                        "buttons": [{
                                extend: 'print', // seharusnya 'print', bukan 'printHtml5'
                                text: 'Print', // perbaikan dari 'textL'
                                exportOptions: {
                                    columns: ':not(:first-child)' // Mengecualikan kolom pertama
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                text: 'Excel', // perbaikan dari 'textL'
                                exportOptions: {
                                    columns: ':not(:first-child)' // Mengecualikan kolom pertama
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                exportOptions: {
                                    columns: ':not(:first-child)' // Mengecualikan kolom pertama
                                }
                            }
                        ]
                    }
                },
                "order": [
                    [2, 'asc'],
                ]
            });

            $('table#tablesDeactive').DataTable({
                "procesisng": true,
                "responsive": false,
                "ajax": {
                    "url": "{{ route('employes.deactiveData') }}",
                    "contentType": 'application/json',
                    "type": 'GET',
                    "data": function(d) {
                        return JSON.stringify(d);
                    }
                },
                "columns": [{
                        "data": "actions",
                        "orderable": false,
                        "searchable": false
                    },
                    {
                        "data": "nik"
                    },
                    {
                        "data": "fullname"
                    },
                    {
                        "data": "position"
                    },
                    {
                        "data": "depart_name"
                    },
                    {
                        "data": "join_contract"
                    },
                    {
                        "data": "end_contract"
                    }
                ],
                "pageLength": 5,
                "language": {
                    "entries": {
                        _: 'peoples',
                        1: 'person'
                    }
                },
                "layout": {
                    "topStart": {
                        "pageLength": {
                            "menu": [5, 10, 25, 50]
                        },
                        "buttons": [
                            'print', 'excel', 'pdf'
                        ]
                    }
                },
                "order": [
                    [2, 'asc'],
                ]
            });


            $(document).on('click', 'table#tables tr td a.editDatatables', function(e) {
                let url = $(this).attr('data-bs-role');

                $.ajax({
                    url: url,
                    data: $(this).serialize(),
                    success: function(e) {
                        $('.modal-content').html(e);
                    }
                });
            });

            $(document).on('click', 'table#tablesDeactive tr td a.editDatatables', function(e) {
                let url = $(this).attr('data-bs-role');

                $.ajax({
                    url: url,
                    data: $(this).serialize(),
                    success: function(e) {
                        $('.modal-content').html(e);
                    }
                });
            });

            $('div#cardEmployes').on('click', function(e) {
                window.location.href = $(this).attr('data-bs-role');
            });
        });
    </script>
@endpush

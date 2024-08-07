@extends('layouts.template_admin.layout')

@push('title')
    HRD - Dashboard
@endpush

@push('headling')
    Employes
@endpush

@push('subheadling')
    {{ Breadcrumbs::render('hrd.employes') }}
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('build/assets/apexchart/dist/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/datatables/datatables.css') }}">
    <style>
        .dataTables_wrapper {
            font-size: 10px;
        }
    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
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
        <div class="col-sm-6 col-md-6">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-hover table-condensed table-borderless table-striped"
                            id="tables">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Employes</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('build/assets/apexchart/dist/apexcharts.js') }}"></script>
    <script src="{{ asset('build/assets/datatables/datatables.js') }}"></script>

    <script>
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
                    "data": "nik"
                },
                {
                    "data": "fullname"
                },
                {
                    "data": "position"
                },
                {
                    "data": "department_id"
                },
                {
                    "data": "join_contract"
                },
                {
                    "data": "end_contract"
                },
                {
                    "data": "department_id"
                },
            ],
            "pageLength": 5,
            "language": {
                "entries": {
                    _: 'people',
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
        });
    </script>
@endpush

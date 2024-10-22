@extends('layouts.template_admin.layout')

@push('title')
    Super Admin - Management Role Entitlement Leave
@endpush

@push('headling')
    Role Entitlement Leave
@endpush

@push('subheadling')
    {{ Breadcrumbs::render('superadmin.management.roleentitlement') }}
@endpush

@push('style')
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/apexcharts/dist/apexcharts.css') }}"> --}}
    <link href="{{ asset('build/assets/datatables/partials/bs.datatables.min.css') }}" rel="stylesheet">
    <style>
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            /* Bayangan saat hover */
        }

        .card-header span {
            font-weight: bold;
        }

        .text-red {
            color: red;
            font-size: 18px;
        }

        .text-green {
            color: green;
            font-size: 18px;
        }
    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>List Entitlement Access</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 table-responsive">
                            <table class="display table table-hover table-condensed table-borderless table-striped"
                                id="tablesRoleEntitlement">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>User ID</th>
                                        <th>Employee ID</th>
                                        <th>NIK</th>
                                        <th>Employee</th>
                                        <th>Department</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th>Active</th>
                                        <th>Need SPV</th>
                                        <th>Need Cor</th>
                                        <th>Need PM</th>
                                        <th>Need Prododucer</th>
                                        <th>Need HOD</th>
                                        <th>Need GM</th>
                                        <th>Need Verifi (HR)</th>
                                        <th>Need Confirmed (HRD)</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
    {{-- <script src="{{ asset('build/assets/apexcharts/dist/apexcharts.js') }}" defer></script> --}}
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

            function showNotificationUrl(type, message, from, align, icon, url) {
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

            function showNotificationUrlRoleAccess(type, message, from, align, icon) {
                $.notify({
                    title: 'Role Access',
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
            @if (session('dangerRoleAccess'))
                @if ($errors->any())
                    let errors = {!! json_encode($errors->all()) !!};
                    errors.forEach(function(error) {
                        showNotificationUrlRoleAccess('danger', error, 'top', 'right',
                            'far fa-times-circle');
                    });
                @endif
            @endif

            @if (session('danger'))
                showNotificationUrl('danger', '{{ session('danger') }}', 'top', 'right', 'fas fa-user-alt-slash');
            @endif

            // Cek apakah ada session danger
            @if (session('success'))
                showNotification('success', '{{ session('success') }}', 'top', 'right', 'fas fa-user');
            @endif
        });

        $(document).ready(function() {

            $('#tablesRoleEntitlement').DataTable({
                "processing": false,
                "serverSide": false,
                "ajax": {
                    "url": "{{ route('management-role-entitlement.data') }}",
                    "contentType": 'application/json',
                    "type": 'GET',
                    "data": function(d) {
                        return JSON.stringify(d);
                    }
                },
                "columns": [{
                        "data": "actions",
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        "data": "user_id"
                    },
                    {
                        "data": "id"
                    },
                    {
                        "data": "nik"
                    },
                    {
                        "data": "fullname"
                    },
                    {
                        "data": "department"
                    },
                    {
                        "data": "position"
                    },
                    {
                        "data": "emp_status"
                    },
                    {
                        "data": "actived",
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        "data": "spv",
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        "data": "coor",
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        "data": "pm",
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        "data": "producer",
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        "data": "hod",
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        "data": "gm",
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        "data": "verify",
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        "data": "confirmed",
                        'orderable': false,
                        'searchable': false
                    },
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
                    [4, 'asc'],
                ]
            });

            $(document).on('click', 'table#tablesRoleEntitlement tr td a.showDatatables', function(e) {
                let url = $(this).attr('data-bs-role');

                $.ajax({
                    url: url,
                    data: $(this).serialize(),
                    success: function(e) {
                        $('.modal-content').html(e);
                    }
                });
            });
        });
    </script>
@endpush

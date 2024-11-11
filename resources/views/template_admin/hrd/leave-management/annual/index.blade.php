@extends('layouts.template_admin.layout')

@push('title')
    Leave Management - Annual
@endpush

@push('headling')
    Leave Management - Annual
@endpush

@push('subheadling')
    anual
@endpush

@push('style')
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

@section('body')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>List Annual Employes</span>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless table-condensed" width="100%" id="tables">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Employee</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Annual</th>
                                <th>Exdo</th>
                                <th>Status</th>
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
@endsection

@push('style')
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

@push('script')
    <script src="{{ asset('build/assets/datatables/partials/bs.datatables.min.js') }}" defer></script>
    <script src="{{ asset('build/assets/datatables/partials/pdfmake.min.js') }}" defer></script>
    <script src="{{ asset('build/assets/datatables/partials/vfs_fonts.js') }}" defer></script>
    <script src="{{ asset('template/administrator/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}" defer>
    </script>

    <script>
        $(document).ready(function() {
            function showNotification(type, message, from, align, icon, title) {
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

            // Cek apakah ada session success
            @if (session('danger'))
                showNotification('danger', '{{ session('danger') }}', 'top', 'right', 'fas fa-file', 'DANGER');
            @endif

            // Cek apakah ada session danger
            @if (session('success'))
                showNotification('success', '{{ session('success') }}', 'top', 'right', 'fas fa-file', 'SUCCESS');
            @endif

            @if (session('info'))
                showNotification('info', '{{ session('info') }}', 'top', 'right', 'fas fa-exclamation',
                    'INFORMATION');
            @endif

        });
    </script>

    <script>
        $(document).ready(function() {
            $('table#tables').DataTable({
                "procesisng": true,
                "responsive": false,
                "ajax": {
                    "url": "{{ route('employee-leave.annual.data') }}",
                    "contentType": 'application/json',
                    "type": 'GET',
                    "data": function(d) {
                        return JSON.stringify(d);
                    }
                },
                "columns": [{
                        "data": "nik",
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
                        "data": "annual"
                    },
                    {
                        "data": "exdo"
                    },
                    {
                        "data": "emp_status"
                    },
                    {
                        "data": "join_contract"
                    },
                    {
                        "data": "end_contract"
                    },
                    {
                        "data": "actions",
                        "searchable": false,
                        "orderable": false
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
                                    columns: ':not(:last-child)' // Mengecualikan kolom pertama
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                text: 'Excel', // perbaikan dari 'textL'
                                exportOptions: {
                                    columns: ':not(:last-child)' // Mengecualikan kolom pertama
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                exportOptions: {
                                    columns: ':not(:last-child)' // Mengecualikan kolom pertama
                                }
                            }
                        ]
                    }
                },
                "order": [
                    [1, 'asc'],
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


        });
    </script>
@endpush

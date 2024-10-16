@extends('layouts.template_admin.layout')

@push('title')
    Applying Leave - Dashboard
@endpush

@push('headling')
    Dashboard
@endpush

@push('subheadling')
    {{ Breadcrumbs::render('applying-leave.dashboard') }}
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
        <div class="col-sm-6 col-md-5">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>Leave Category</span>
                </div>
                <div class="card-body">
                    <table class="table table-condensed table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Annual <sup>(Ongoing Month)</sup></td>
                                <td>{{ $monthComming }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary btn-rounded"
                                        data-bs-role="{{ route('applying-leave-annual.create') }}"
                                        id="buttonApply">Apply</button>
                                    @if ($monthComming > 0)
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Exdo</td>
                                <td>10</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary btn-rounded" data-bs-role="456"
                                        id="buttonApply">Apply</butt>
                                </td>
                            </tr>
                            <tr>
                                <td>Etc</td>
                                <td>-</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary btn-rounded" data-bs-role=""
                                        id="buttonApply">Apply</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Annual <sup>(Until EOC)</sup></td>
                                <td>{{ $annualeave->annual }}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger btn-rounded" data-bs-role=""
                                        id="buttonApply">Apply</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-7">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>Form Progress</span>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed table-borderless">
                        <thead>
                            <tr>
                                <th>Start Leave</th>
                                <th>End Leave</th>
                                <th>Back To Work</th>
                                <th>Category</th>
                                <th>Day</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-5">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>Exdo</span>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condesed table-borderless">
                        <thead>
                            <tr>
                                <th>Expired</th>
                                <th>Initial</th>
                                <th>Limit</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-7">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>Form History</span>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed table-borderless">
                        <thead>
                            <tr>
                                <th>Start Leave</th>
                                <th>End Leave</th>
                                <th>Back To Work</th>
                                <th>Category</th>
                                <th>Day</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
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
            $('table#tables1').DataTable({
                "procesisng": true,
                "responsive": false,
                "ajax": {
                    "url": "{{ route('employes.annualeave.data') }}",
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


            $(document).on('click', 'table#tables1 tr td a.editDatatables', function(e) {
                let url = $(this).attr('data-bs-role');

                $.ajax({
                    url: url,
                    data: $(this).serialize(),
                    success: function(e) {
                        $('.modal-content').html(e);
                    }
                });
            });

            $('button#buttonApply').replaceWith(function() {
                return $('<a>', {
                    href: $(this).attr('data-bs-role'), // Sesuaikan href sesuai kebutuhan
                    id: this.id,
                    class: this.className,
                    html: $(this).html()
                });
            });

        });
    </script>
@endpush

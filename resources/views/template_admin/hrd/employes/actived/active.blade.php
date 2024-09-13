@extends('layouts.template_admin.layout')

@push('title')
    HRD - Employes
@endpush

@push('headling')
    Employes
@endpush

@push('subheadling')
    {{ Breadcrumbs::render('hrd.employes.actived') }}
@endpush

@push('manageBtn')
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" id="manageDropdownList">
        <a class="dropdown-item" href="{{ route('employes.index') }}">Dashboard</a>
        <a class="dropdown-item" href="{{ route('employes.create') }}">Add Employee</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Deactive</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Chart</a>
    </ul>
@endpush

@push('style')
    <link href="{{ asset('build/assets/datatables/partials/bs.datatables.min.css') }}" rel="stylesheet">

    <style>
        sup#supClass2 {
            color: green;
        }

        sup#supClass1 {
            color: red;
        }
    </style>
@endpush
@section('body')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>List Employes Active</span>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="display table table-sm table-hover table-condensed table-borderless table-striped"
                            width="100%" id="tables">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Employes</th>
                                    <th>Gender</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Emp. Stat.</th>
                                    <th>Place & Birth</th>
                                    <th>Province</th>
                                    <th>Religion</th>
                                    <th>Maiden</th>
                                    <th>Email</th>
                                    <th>ID Card</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Education</th>
                                    <th>Marital Status</th>
                                    <th>NPWP</th>
                                    <th>KK</th>
                                    <th>BPJS Kesehatan</th>
                                    <th>BPJS Ketenagakerjaan</th>
                                    <th>Annual</th>
                                    <th>Exdo</th>
                                    <th>Action</th>
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
    <script src="{{ asset('build/assets/datatables/partials/bs.datatables.min.js') }}" defer></script>
    <script src="{{ asset('build/assets/datatables/partials/pdfmake.min.js') }}" defer></script>
    <script src="{{ asset('build/assets/datatables/partials/vfs_fonts.js') }}" defer></script>

    <script>
        $(document).ready(function() {
            $('table#tables').DataTable({
                "procesisng": true,
                "responsive": true,
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
                        "data": "gender"
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
                    },
                    {
                        "data": "emp_status"
                    },
                    {
                        "data": "place_birth"
                    },
                    {
                        "data": "province"
                    },
                    {
                        "data": "religion"
                    },
                    {
                        "data": "maiden"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "id_card"
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "data": "alamat"
                    },
                    {
                        "data": "jenjang"
                    },
                    {
                        "data": "marital_status"
                    },
                    {
                        "data": "npwp"
                    },
                    {
                        "data": "kk"
                    },
                    {
                        "data": "bpjs_kesehatan"
                    },
                    {
                        "data": "bpjs_ketenagakerjaan"
                    },
                    {
                        "data": "annual"
                    },
                    {
                        "data": "exdo"
                    },
                    {
                        "data": "actions",
                        "orderable": false,
                        "searchable": false
                    },
                ],
                "pageLength": 25,
                "language": {
                    "entries": {
                        _: 'peoples',
                        1: 'person'
                    }
                },
                "layout": {
                    "topStart": {
                        "pageLength": {
                            "menu": [25, 50, 100, 150]
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
                                },
                                pageSize: "A2",
                                orientation: 'landscape',
                                fontSize: 10,
                                customize: function(doc) {
                                    doc.pageMargins = [20, 20, 20,
                                        20
                                    ]; // Menyesuaikan margin (kiri, atas, kanan, bawah)

                                }
                            }
                        ]
                    }
                },
                "order": [
                    [1, 'asc'],
                ],
                "columnDefs": [{
                    visible: true,
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]
                }],
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

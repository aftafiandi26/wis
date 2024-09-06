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

@push('style')
    <link rel="stylesheet" href="{{ asset('build/assets/datatables/datatables.min.css') }}">
@endpush
@section('body')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>List Employes Active</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-sm table-hover table-condensed table-borderless table-striped"
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
@endsection

@push('script')
    <script src="{{ asset('build/assets/datatables/datatables.js') }}" defer></script>
    <script>
        $(document).ready(function() {
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
                        "buttons": [
                            'print', 'excel', 'pdf'
                        ]
                    }
                },
                "order": [
                    [2, 'asc'],
                ]
            });
        });
    </script>
@endpush

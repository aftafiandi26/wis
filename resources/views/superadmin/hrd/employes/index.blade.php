@extends('layouts.thema') @push('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Employes</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 fontSmallSize2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dass</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endpush @push('style')
<link rel="stylesheet" href="{{ asset('assets/datatables/DataTables/datatables.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/datatables/DataTables/Bootstrap-5-5.1.3/css/bootstrap.css.map') }}"/>
@endpush @section('content')
<div class="container-fluid fontSmallSize">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-condensed table-hover table-bordered" id="employes">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Joined</th>
                        <th>Ended</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
 
<div class="modal fade" id="showViewDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modal-content"></div>
    </div>
</div>
@endsection @push('scripts')
<script src="{{ asset('assets/datatables/DataTables/datatables.js') }}"></script>
<script>
    $(function () {
        $("#employes").DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('superadmin.employes.data') }}",
            columns: [
                {
                    data: "DT_RowIndex",
                },
                {
                    data: "nik",
                },
                {
                    data: "fullname",
                },
                {
                    data: "emp_status",
                },
                {
                    data: "position",
                },
                {
                    data: "department_id",
                },
                {
                    data: "join_of_contract",
                },
                {
                    data: "end_of_contract",
                },
                {
                    data: "actions",
                },
            ],
            buttons: ["copy", "excel", "pdf"],
        });

        $(document).on("click",'table#employes tr td a[id="buttonShow"]', function (e) {
                const url = $(this).attr("data-role");

                $.ajax({
                    url: url,
                    success: function (e) {
                        $("#modal-content").html(e);
                    },
                });
            }
        );
    });
</script>
@endpush

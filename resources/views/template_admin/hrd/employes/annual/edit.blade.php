@extends('layouts.template_admin.layout')

@push('title')
    HRD - Edit Annual
@endpush

@push('headling')
   Leave Transaction
@endpush
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
@push('subheadling')
    {{ Breadcrumbs::render('hrd.employes.annualeave.edit', $employee->id) }}
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
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>Progress Form Employee Leave</span>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless table-condensed" width="100%" id="progressTable">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Employee</th>
                                <th>Category</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Amount Day</th>
                                <th>Back to Work</th>
                                <th>Reason</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <span>Leave Transactions</span>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless table-condensed" width="100%" id="transactionsTable">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Employee</th>
                                <th>Category</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Amount Day</th>
                                <th>Back to Work</th>
                                <th>Reason</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush

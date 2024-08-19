@extends('layouts.template_admin.layout')

@push('title')
    HRD - Employes - Create
@endpush

@push('headling')
    Create
@endpush

@push('subheadling')
    {{ Breadcrumbs::render('hrd.employes.create') }}
@endpush

@push('style')
    <style>
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col col-sm-12 col-md-12 mb-3">
            <div class="btn-group dropstart float-end">
                <button type="button" class="btn btn-outline-primary btn-round dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" id="manageDropdownList">
                    <a class="dropdown-item" href="#">Active</a>
                    <a class="dropdown-item" href="#">Deactive</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Chart</a>
                </ul>
            </div>
        </div>
    </div>


@endsection

@push('script')
@endpush

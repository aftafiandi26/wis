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

@push('manageBtn')

@endpush

@section('body')


@endsection

@push('script')
@endpush

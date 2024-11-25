@extends('layouts.template_admin.layout')

@push('title')
    Applying Leave - Annual
@endpush

@push('headling')
    Annual
@endpush

@push('subheadling')
    {{ Breadcrumbs::render('applying-leave.annual') }}
@endpush

@push('style')
    <style>
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .container-center {
            display: flex;
            justify-content: center;
            /* Memusatkan secara horizontal */
            align-items: center;
            /* Memusatkan secara vertikal */
            height: auto;
            /* Mengatur tinggi container */
        }
    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-stats card-round">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <h4>Annual Form</h4>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <button id="formSubmit" class="btn btn-sm btn-outline-success btn-round float-end">Save</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2 col-md-2"></div>
        <div class="col-sm-8 col-md-8">
            <div class="card card-stas card-round">
                <div class="card-header"></div>
                <div class="card-body">
                    tes
                </div>
            </div>
        </div>
        <div class="col-sm-2 col-md-2"></div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('template/administrator/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}" defer>
    </script>
@endpush

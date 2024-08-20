<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div class="col col-sm-6 col-md-6">
                <h3 class="fw-bold mb-3">@stack('headling')</h3>
                <h6 class="op-7 mb-2">@stack('subheadling')</h6>
            </div>
            <div class="col col-sm-6 col-md-6">
                <div class="btn-group dropstart float-end">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-round dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Manage
                    </button>
                    @stack('manageBtn')
                </div>
            </div>
        </div>
        @yield('body')
    </div>
</div>

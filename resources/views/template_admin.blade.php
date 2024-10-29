@extends('layouts.template_admin.layout')

@push('title')
Dashboard
@endpush

@push('headling')
Dashboard
@endpush

@push('subheadling')
Dashboard
@endpush

@section('body')
<div class="row">
  <div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
            <div
              class="icon-big text-center icon-primary bubble-shadow-small"
            >
              <i class="fas fa-users"></i>
            </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
            <div class="numbers">
              <p class="card-category">Visitors</p>
              <h4 class="card-title">1,294</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
            <div
              class="icon-big text-center icon-info bubble-shadow-small"
            >
              <i class="fas fa-user-check"></i>
            </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
            <div class="numbers">
              <p class="card-category">Subscribers</p>
              <h4 class="card-title">1303</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
            <div
              class="icon-big text-center icon-success bubble-shadow-small"
            >
              <i class="fas fa-luggage-cart"></i>
            </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
            <div class="numbers">
              <p class="card-category">Sales</p>
              <h4 class="card-title">$ 1,345</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
            <div
              class="icon-big text-center icon-secondary bubble-shadow-small"
            >
              <i class="far fa-check-circle"></i>
            </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
            <div class="numbers">
              <p class="card-category">Order</p>
              <h4 class="card-title">576</h4>
            </div>
          </div>
        </div>
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
                showNotification('info', '{{ session('info') }}', 'top', 'right', 'fas fa-exclamation', 'INFORMATION');
            @endif

        });
    </script>
@endpush

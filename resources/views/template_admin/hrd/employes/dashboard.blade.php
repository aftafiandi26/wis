@extends('layouts.template_admin.layout')

@push('title')
HRD - Dashboard
@endpush

@push('headling')
Employes
@endpush

@push('subheadling')
{{ Breadcrumbs::render('hrd.employes') }}
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
              <p class="card-category">Employes</p>
              <h4 class="card-title">{{ $employes->count() }}</h4>
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
              <p class="card-category">Permanent</p>
              <h4 class="card-title">{{ $employes->where('emp_status', 'Permanent')->count() }}</h4>
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
              <p class="card-category">Contract</p>
              <h4 class="card-title">{{ $employes->where('emp_status', 'Contract')->count() }}</h4>
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
              <p class="card-category">Intern</p>
              <h4 class="card-title">{{ $employes->where('emp_status', 'Intern')->count() }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
                  <p class="card-category">Production</p>
                  <h4 class="card-title">{{ $employes->where('department_id', 6)->count() }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="col-sm-6 col-md-9">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="chart-container">
                      <canvas id="employeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    var employeChart = document.getElementById("employeChart").getContext("2d");

    var myLineChart = new Chart(employeChart, {
        type: "line",
        data: {
          labels: [
            "IT",
            "HR",
            "FA",
            "Facility",
            "Operation",
            "Production",
            "Live Shoot",
          ],
          datasets: [
            {
              label: "Active Users",
              borderColor: "#1d7af3",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#1d7af3",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
              data: [
                {{ $employes->where('department_id', 1)->count() }},
                {{ $employes->where('department_id', 2)->count() }},
                {{ $employes->where('department_id', 3)->count() }},
                {{ $employes->where('department_id', 4)->count() }},
                {{ $employes->where('department_id', 5)->count() }},
                {{ $employes->where('department_id', 6)->count() }},
                {{ $employes->where('department_id', 7)->count() }},
              ]
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "bottom",
            labels: {
              padding: 10,
              fontColor: "#1d7af3",
            },
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          layout: {
            padding: { left: 15, right: 15, top: 15, bottom: 15 },
          },
        },
      });
</script>
@endpush

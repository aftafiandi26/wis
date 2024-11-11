<li class="nav-item">
    <a data-bs-toggle="collapse" href="#sidebar_hr_employes" class="collapsed" aria-expanded="false">
      <i class="fas fa-users"></i>
      <p>Employes</p>
      <span class="caret"></span>
    </a>
    <div class="collapse" id="sidebar_hr_employes">
      <ul class="nav nav-collapse">
        <li>
          <a href="{{ route('employes.index') }}">
            <span class="sub-item">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('employes.create') }}">
            <span class="sub-item">Add Employee</span>
          </a>
        </li>
        <li>
          <a href="{{ route('employes.actived') }}">
            <span class="sub-item">Actived</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="sub-item">Deactived</span>
          </a>
        </li>
    </ul>
    </div>
  </li>
  {{--  --}}
  <li class="nav-item">
    <a data-bs-toggle="collapse" href="#sidebar_hr_employee_leave" class="collapsed" aria-expanded="false">
      <i class="fas fa-user-clock"></i>
      <p>Leave Management</p>
      <span class="caret"></span>
    </a>
    <div class="collapse" id="sidebar_hr_employee_leave">
      <ul class="nav nav-collapse">
        <li>
          <a href="{{ route('employee-leave-dashboard.index') }}">
            <span class="sub-item">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('leave-management-annual.index') }}">
            <span class="sub-item">Annual</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="sub-item">Exdo</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="sub-item">Etc</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="sub-item">Form Leave Progress</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="sub-item">Leave Transactions</span>
          </a>
        </li>
      </ul>
    </div>
  </li>

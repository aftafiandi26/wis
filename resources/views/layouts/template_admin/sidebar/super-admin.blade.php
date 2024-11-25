<li class="nav-item">
    <a data-bs-toggle="collapse" href="#sidebar_management_role" class="collapsed" aria-expanded="false">
        <i class="fas fa-file-archive"></i>
        <p>Management Role</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="sidebar_management_role">
        <ul class="nav nav-collapse">
            <li>
                <a href="{{ route('management-role-access.index') }}">
                    <span class="sub-item">Role Access</span>
                </a>
            </li>
            <li>
                <a href="{{ route('management-role-entitlement.index') }}">
                    <span class="sub-item">Role Entitlement Leave</span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a data-bs-toggle="collapse" href="#sidebar_management_user" class="collapsed" aria-expanded="false">
        <i class="fas fa-file-archive"></i>
        <p>Management User</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="sidebar_management_user">
        <ul class="nav nav-collapse">
            <li>
                <a href="#">
                    <span class="sub-item">Dashboard</span>
                </a>
            </li>
        </ul>
    </div>
</li>
{{--  --}}
<li class="nav-item">
    <a href="#">
        <i class="fas fa-home"></i>
        <p>Attendance</p>
    </a>
</li>

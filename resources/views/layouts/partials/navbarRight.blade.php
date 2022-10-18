<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-power-off"> </i>
                    <p>
                        logout
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
            </li>
        </ul>
    </nav>
</aside>
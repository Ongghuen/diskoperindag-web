<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            {{-- <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="mdi mdi-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" href="/user">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/bantuan">
                    <i class="mdi mdi-chart-pie menu-icon"></i>
                    <span class="menu-title">Bantuan</span>
                </a>
            </li>
        </ul>
    </nav>

    @include('partials.content')
</div>

</div>

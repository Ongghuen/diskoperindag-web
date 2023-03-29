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
                    <span class="menu-title">Pengguna</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="mdi mdi-chart-pie menu-icon"></i>
                    <span class="menu-title">Fasilitas</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="/bantuan">Item</a></li>
                        <li class="nav-item"> <a class="nav-link" href="/pelatihan">Pelatihan</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="/sertifikat">Sertifikat</a></li>
                    </ul>

                </div>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="/bantuan">
                    <i class="mdi mdi-chart-pie menu-icon"></i>
                    <span class="menu-title">Bantuan</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" href="/item">
                    <i class="mdi mdi-dns menu-icon"></i>
                    <span class="menu-title">Item</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/report">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Report</span>
                </a>
            </li>
        </ul>
    </nav>

    @include('partials.content')
</div>

</div>

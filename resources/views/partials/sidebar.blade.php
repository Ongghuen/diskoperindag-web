<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/user">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Pengguna</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false"
                    aria-controls="ui-basic1">
                    <i class="mdi mdi-chart-pie menu-icon"></i>
                    <span class="menu-title">Fasilitasi</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic1">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="/bantuan">Alat</a></li>
                        <li class="nav-item"> <a class="nav-link" href="/pelatihan">Pelatihan</a></li>
                        <li class="nav-item"> <a class="nav-link" href="/sertifikat">Sertifikat</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/alatitem">
                    <i class="mdi mdi-dns menu-icon"></i>
                    <span class="menu-title">Alat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/berita">
                    <i class="mdi mdi-newspaper menu-icon"></i>
                    <span class="menu-title">Berita</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/report">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>
        </ul>
    </nav>
    @include('partials.content')
</div>

</div>

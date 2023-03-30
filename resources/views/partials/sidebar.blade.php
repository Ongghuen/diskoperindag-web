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
                        <li class="nav-item"> <a class="nav-link" href="/pelatihanfasilitas">Pelatihan</a></li>
                        <li class="nav-item"> <a class="nav-link" href="/sertifikatfasilitas">Sertifikat</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false"
                    aria-controls="ui-basic2">
                    <i class="mdi mdi-dns menu-icon"></i>
                    <span class="menu-title">Item</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" id="item" href="/alatitem">Alat</a></li>
                        <li class="nav-item"> <a class="nav-link" id="pelatihan" href="/pelatihanitem">Pelatihan</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" id="sertifikat" href="/sertifikatitem">Sertifikat</a>
                        </li>
                    </ul>
                </div>
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

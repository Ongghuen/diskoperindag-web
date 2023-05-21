 <!--**********************************
        Sidebar start
    ***********************************-->
 <div class="nk-sidebar">
     <div class="nk-nav-scroll">
         <ul class="metismenu" id="menu">
             <li>
                 <a href="/user" aria-expanded="false">
                     <i class="icon-user menu-icon"></i><span class="nav-text">Pengguna</span>
                 </a>
             </li>
             @if (Auth::User()->role_id == 1)
                <li>
                    <a href="/admin" aria-expanded="false">
                        <i class="icon-user-following menu-icon"></i><span class="nav-text">Admin</span>
                    </a>
                </li>
             @endif
             <li>
                 <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                     <i class="icon-grid menu-icon"></i><span class="nav-text">Fasilitasi</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="/bantuan">Bantuan Alat</a></li>
                     <li><a href="/sertifikat">Sertifikat</a></li>
                     <li><a href="/pelatihan">Pelatihan</a></li>
                 </ul>
             </li>
             <li>
                 <a href="/alatitem" aria-expanded="false">
                     <i class="icon-note menu-icon"></i><span class="nav-text">Alat</span>
                 </a>
             </li>
             <li>
                 <a href="/berita" aria-expanded="false">
                     <i class="icon-notebook menu-icon"></i><span class="nav-text">Berita</span>
                 </a>
             </li>
             <li>
                 <a href="/report" aria-expanded="false">
                     <i class="icon-graph menu-icon"></i><span class="nav-text">Laporan</span>
                 </a>
             </li>
             <li>
                 <a href="/notifikasi" aria-expanded="false">
                     <i class="icon-info menu-icon"></i><span class="nav-text">Notifikasi</span>
                 </a>
             </li>
         </ul>
         </li>
         </ul>
     </div>
 </div>
 <!--**********************************
        Sidebar end
    ***********************************-->

 <!--**********************************
        Content body start
    ***********************************-->

 @include('partials.content')

 <!--**********************************
        Content body end
    ***********************************-->


 <!--**********************************
        Footer start
    ***********************************-->

 @include('partials.footer')

 @include('partials.logoutmodal')

 @include('partials.profilemodal')

 <!--**********************************
        Footer end
    ***********************************-->

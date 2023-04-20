<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="/user"><img src={{ asset('images/logo-tuansilat.svg') }} alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="/user"><img src={{ asset('images/logo-tuansilat-mini.svg') }} alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant"></span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <img src={{ asset('images/profile.jpg') }} alt="profile" />
                    <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <button data-bs-toggle="modal" data-bs-target="#logoutmodal" class="dropdown-item"><i
                            class="mdi mdi-logout text-primary"></i>
                        Logout</button>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="header">
    <div class="header-content clearfix">
        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown d-none d-md-flex">
                    <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
                        <span>{{ Auth::User()->name }}</span>
                    </a>
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="{{ asset('images/user/form-user.png') }}" height="40" width="40" alt="">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                @if (Auth::User()->role_id == 2)
                                <li>
                                    <a data-toggle="modal" data-target="#profileModal" href="#"><i
                                    class="icon-user"></i> <span>Ganti password</span></a>
                                </li>
                                @endif
                                <div class="my-2"></div>
                                <li><a data-toggle="modal" data-target="#logoutModal" href="#"><i
                                    class="icon-key"></i> <span>Logout</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

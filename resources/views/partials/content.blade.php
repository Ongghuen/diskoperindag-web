<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">
                        <div class="me-md-3 me-xl-5">
                            <h2>Halaman @yield('title-page')</h2>
                            <p class="mb-md-0">@yield('tagline')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
        @include('partials.footer')

    </div>
    @include('partials.logout_profil')

</div>

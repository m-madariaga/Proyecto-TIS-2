<div class="fixed-plugin">
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3 ">
            <div class="row">
                <div class="col-1" id="btn_close">
                    <div class="float-end mt-1">
                        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                            <i class="ni ni-bold-right me-1" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row" id="header">
                <h5 id="setting_header">
                    <img src="/argon/assets/img/team-1.jpg" alt="profile_image" id="profile_image"
                        class="border-radius-lg shadow-sm ">

                    {{ Auth::user()->name }}
                </h5>
            </div>
        </div>

        <hr class="horizontal dark mt-4 my-1">
        <div class="card-body pt-sm-3 pt-1 overflow-auto">
            <div class="d-flex my-3">
                <h6 class="mb-0">Profile</h6>
                <a class="ps-0 ms-auto my-auto" href="{{ route('profile') }}">
                    <p class="text-md mb-0">
                        <i class="ni ni-circle-08 me-1" aria-hidden="true"></i>
                    </p>
                </a>
            </div>

            <!-- ------------------------------------------ -->
            <hr class="horizontal dark my-sm-4">
            <!-- ------------------------------------------ -->

            <div class="d-flex my-3">
                <h6 class="mb-0">Navbar Fixed</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                        onclick="navbarFixed(this)">
                </div>
            </div>

            <!-- ------------------------------------------ -->
            <hr class="horizontal dark my-sm-4">
            <!-- ------------------------------------------ -->

            <div class="mt-2 mb-5 d-flex">
                <h6 class="mb-0">Light / Dark</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark_version"
                        onclick="darkMode(this)">
                </div>
            </div>

            <!-- ------------------------------------------ -->
            <hr class="horizontal dark my-sm-4">
            <!-- ------------------------------------------ -->

            <div class="d-flex my-3">
                <h6 class="mb-0">Sign off</h6>

                <a class="ps-0 ms-auto my-auto" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <p class="text-md mb-0">
                        <i class="ni ni-user-run me-1" aria-hidden="true"></i>
                    </p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

            <!-- ------------------------------------------ -->
            <hr class="horizontal dark my-sm-4">
            <!-- ------------------------------------------ -->

            <div class="w-100 text-center">

                <h6 class="mt-3">Social networks</h6>

                <a href="https://www.instagram.com/que.guay_/" class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-instagram me-1" aria-hidden="true"></i> Instagram
                </a>
            </div>
        </div>
    </div>
</div>

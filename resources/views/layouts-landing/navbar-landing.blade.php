<head>
    <!-- Template Main JS File -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/owl.carousel.js"></script>
    <script src="assets/js/easing.js"></script>
    <script src="assets/js/custom.js"></script>
</head>

<div class="top_nav">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6 text-right">
                <div class="top_nav_right">
                    <ul class="top_nav_menu">

                        <!-- Language / My Account -->

                        <li class="language">
                            <a href="#">
                                English
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="language_selection">
                                <li><a href="#">French</a></li>
                                <li><a href="#">Italian</a></li>
                                <li><a href="#">German</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </li>
                        <li class="account">
                            <a href="#">
                                @if (Auth::check())
                                {{ Auth::user()->name }}
                                @else
                                My Account
                                @endif
                                <i class="fa fa-angle-down"></i>
                            </a>
                            @if (Auth::check())
                            <ul class="account_selection">
                                <li>
                                    <a href="{{ route('profile_landing') }}">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            @else
                            <ul class="account_selection">
                                <li>
                                    <a href="{{ route('login') }}">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i> Sign In
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i> Register
                                    </a>
                                </li>
                            </ul>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
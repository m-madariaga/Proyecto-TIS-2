<head>

    <style>
        .socialnetwork-item {
            display: inline-block;
            margin-right: 10px;
        }
    </style>

</head>

<div class="top_nav px-4">
    <div class="row">
        <div class="col-md-6 text-left">
            <div class="top_nav_left">

                @foreach ($socialnetworks as $socialnetwork)
                @if ($socialnetwork->visible == '1')
                <div class="socialnetwork-item">
                    @if (strtolower($socialnetwork->nombre) == strtolower('Número Teléfonico'))
                    <div class="top_nav_left">
                        <i class="fa fa-phone" style="color:white" aria-hidden="true"></i>
                        <span style="color:white">{{ $socialnetwork->valor }}</span>
                    </div>
                    @elseif (strtolower($socialnetwork->nombre) == 'facebook')
                    <div class="top_nav_left">
                        <a href="{{ $socialnetwork->valor }}" target="_blank">
                            <i class="fa fa-facebook" style="color:white" aria-hidden="true"></i>
                        </a>
                    </div>
                    @elseif (strtolower($socialnetwork->nombre) == 'instagram')
                    <div class="top_nav_left">
                        <a href="{{ $socialnetwork->valor }}" target="_blank">
                            <i class="fa fa-instagram" style="color:white" aria-hidden="true"></i>
                        </a>
                    </div>
                    @elseif (strtolower($socialnetwork->nombre) == 'twitter')
                    <div class="top_nav_left">
                        <a href="{{ $socialnetwork->valor }}" target="_blank">
                            <i class="fa fa-twitter" style="color:white" aria-hidden="true"></i>
                        </a>
                    </div>
                    @else
                    <div class="top_nav_left">
                        <a href="{{ $socialnetwork->valor }}" target="_blank">
                            <i class="fa fa-share" style="color:white" aria-hidden="true"></i>
                        </a>
                    </div>
                    @endif
                </div>
                @endif
                @endforeach
            </div>

        </div>
        <div class="col-md-6 text-right">
            <div class="top_nav_right">
                <ul class="top_nav_menu">
                    <!-- <li class="language">
                        <a href="#">
                            Idioma
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="language_selection">
                            <li><a href="#">Inglés</a></li>
                            <li><a href="#">Español</a></li>
                        </ul>
                    </li> -->

                    <li class="account">
                        <a href="#">
                            @guest
                            Cuenta
                            @else
                            {{ Auth::user()->name }}
                            @endguest
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="account_selection">
                            @guest
                            <li>
                                <a href="{{ route('login') }}">
                                    Iniciar sesión
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">
                                    Registrarse
                                </a>
                            </li>
                            @else
                            <li>
                                <a href="{{ route('profile_landing') }}">
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @if (Auth::check() && Auth::user()->hasRole('admin'))
                            <li>
                                <a href="{{route('admin_home')}}">
                                    Vista Administrador
                                </a>
                            </li>
                            @endif
                            @endguest
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
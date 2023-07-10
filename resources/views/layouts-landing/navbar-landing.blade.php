<head>
    <style>
        .socialnetwork-item {
            display: inline-block;
            margin-right: 10px;
        }

        .text-center-sm {
            text-align: center;
        }

        @media (max-width: 579px) {
            .text-center-sm {
                text-align: center;
                justify-content: center;
            }

        }

        #login {
            margin-right: 5px;
        }

        @media (max-width: 396px) {
            .text-center-sm {
                text-align: center;
                justify-content: center;
            }

            #login {
                margin-right: -1px;
            }
        }
    </style>
</head>

<div class="top_nav px-4">
    <div class="row">
        <div class="col-xs-6 col-sm-6 text-left text-center-sm">
            @foreach ($socialnetworks as $socialnetwork)
                @if ($socialnetwork->visible == '1')
                    <div class="socialnetwork-item">
                        @if (strtolower($socialnetwork->nombre) == strtolower('Número Teléfonico'))
                            <div class="top_nav_left mt-2">
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
        <div class="col-xs-6 col-sm-6 text-right mt-2">
            @guest

                <a href="{{ route('login') }} " class="mt-2" id="login"style="color: white">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"style="color: white">
                    Registrarse
                </a>
            @else
                <a class="account_cl" href="#">
                    @guest
                        Cuenta
                    @else
                        {{ Auth::user()->name }}
                    @endguest
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="account_selection">
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <li>
                            <a href="{{ route('admin_home') }}">
                                Vista Administrador
                            </a>
                        </li>
                    @endif
                    @if (Auth::check())
                        <li>
                            <a href="{{ route('profile_landing') }}">
                                Perfil
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li>
                            <span href="{{ route('login') }}">
                                Iniciar sesión
                            </span>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">
                                Registrarse
                            </a>
                        </li>
                    @endif
                </ul>

                </li>
            @endguest
        </div>
    </div>
</div>

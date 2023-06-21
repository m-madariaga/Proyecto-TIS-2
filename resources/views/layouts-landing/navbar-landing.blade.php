<div class="top_nav px-4">
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="top_nav_right">
                <ul class="top_nav_menu">
                    <li class="language">
                        <a href="#">
                            Idioma
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="language_selection">
                            <li><a href="#">Inglés</a></li>
                            <li><a href="#">Español</a></li>
                        </ul>
                    </li>

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
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

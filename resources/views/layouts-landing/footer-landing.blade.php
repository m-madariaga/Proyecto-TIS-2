<footer class="footer px-4">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 mb-3 mt-3 d-flex flex-column align-items-start">
            <div class="col-lg-8 col-md-6 mb-3 mt-3 d-flex flex-column align-items-center">
                <div>
                    <a href="{{ route('home-landing') }}">
                        <img src="{{ asset('assets/images/logo_2.png') }}" style="max-height: 3rem;" alt="Logo">
                    </a>
                </div>
                <div>
                    <p class="">Tu estilo, tu moda</p>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-6 col-sm-6 mb-3 mt-3 footer_nav">
            <h5><strong>Redes Sociales</strong></h5>
            <ul>
                @foreach ($socialnetworks as $socialnetwork)
                @if ($socialnetwork->visible == '1')
                @if (strtolower($socialnetwork->nombre) == strtolower('Número Teléfonico'))
                <li class="mb-2 footer_redes">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span class="footer_redes">{{ $socialnetwork->valor }}</span>
                </li>
                @elseif (strtolower($socialnetwork->nombre) == 'facebook')
                <li class="mb-2">
                    <a href="{{ $socialnetwork->valor }}" target="_blank">
                        <i class="fa fa-facebook footer_redes" aria-hidden="true"></i>
                        Facebook
                    </a>
                </li>
                @elseif (strtolower($socialnetwork->nombre) == 'instagram')
                <li class="mb-2 footer_redes">
                    <a href="{{ $socialnetwork->valor }}" target="_blank">
                        <i class="fa fa-instagram footer_redes" aria-hidden="true"></i>
                        Instagram
                    </a>
                </li>
                @elseif (strtolower($socialnetwork->nombre) == 'twitter')
                <li class="mb-2">
                    <a href="{{ $socialnetwork->valor }}" target="_blank">
                        <i class="fa fa-twitter footer_redes" aria-hidden="true"></i>
                        Twitter
                    </a>
                </li>
                @else
                <li class="mb-2">
                    <a href="{{ $socialnetwork->valor }}" target="_blank">
                        <i class="fa fa-share footer_redes"aria-hidden="true"></i>
                    </a>
                </li>
                @endif
                @endif
                @endforeach
            </ul>
        </div>

        <div class="col-lg-2 col-md-6 col-sm-6 mb-3 mt-3 footer_nav">
            <h5><strong>Enlaces</strong></h5>
            <ul>
                @foreach ($sections as $section)
                @if ($section->visible === 1)

                @if (strtolower($section->nombre) === 'mujer')
                <li class="mb-2">
                    <a href="{{ route('women') }}">{{ $section->nombre }}</a>
                </li>
                @elseif (strtolower($section->nombre) === 'hombre')
                <li class="mb-2">
                    <a href="{{ route('men') }}">{{ $section->nombre }}</a>
                </li>
                @elseif (strtolower($section->nombre) === 'niños')
                <li class="mb-2">
                    <a href="{{ route('kids') }}">{{ $section->nombre }}</a>
                </li>
                @elseif (strtolower($section->nombre) === 'accesorios')
                <li class="mb-2">
                    <a href="{{ route('accesorie') }}">{{ $section->nombre }}</a>
                </li>
                @endif
                @endif
                @endforeach
            </ul>
        </div>

        <div class="col-lg-2 col-md-6 col-sm-6 mb-3 mt-3 footer_nav">
            <h5><strong>Ayuda</strong></h5>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('termsconditionsview.index') }}">Términos y condiciones</a>
                </li>
                <li class="mb-2">
                    <a href="{{route('questionview.index')}}">Preguntas frecuentes</a>
                </li>
                <li class="mb-2">
                    <a href=""></a>
                </li>
                <li class="mb-2">
                    <a href=""></a>
                </li>
            </ul>
        </div>

        <div class="col-lg-2 col-md-6 col-sm-6 mb-3 mt-3 footer_nav">
            <h5><strong>Sobre Que Guay!</strong></h5>

            <ul>
                <li class="mb-2">
                    <a href="{{ route('knowmeview.index') }}">Conócenos</a>
                </li>
                <li class="mb-2">
                    <a href=""></a>
                </li>
                <li class="mb-2">
                    <a href=""></a>
                </li>
                <li class="mb-2">
                    <a href=""></a>
                </li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 d-flex flex-column align-items-center text-center">
           
            <div class="d-flex flex-row align-items-center justify-content-center mt-4">
                <p>&copy; 2023 Que guay!. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>
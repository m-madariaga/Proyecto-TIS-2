<footer class="footer px-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 mb-3 mt-3 d-flex flex-column align-items-start">
            <div class="col-lg-3 col-md-6 mb-3 mt-3 d-flex flex-column align-items-center">
                <div>
                    <a href="{{ route('home-landing') }}">
                        <img src="{{ asset('assets/images/logo_2.png') }}" style="max-height: 3rem;" alt="Logo"> </a>

                </div>
                <div>
                    <p class="">Tu estilo, tu moda</p>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-6 col-sm-6 mb-3 mt-3 footer_nav">
            <h5><strong>Enlaces</strong></h5>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('men') }}">Hombre</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('women') }}">Mujer</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('kids') }}">Niños</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('accesorie') }}">Accesorios</a>
                </li>
            </ul>
        </div>

        <div class="col-lg-2 col-md-6 col-sm-6 mb-3 mt-3 footer_nav">
            <h5><strong>Ayuda</strong></h5>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('termsconditionsview.index') }}">Términos y condiciones</a>
                </li>
                <li class="mb-2">
                    <a href="">Preguntas frecuentes</a>
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
            <div class="footer_social d-flex flex-row align-items-center justify-content-center">
                <ul>
                    <li><a href="https://www.instagram.com/que.guay_/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram</a></li>
                </ul>
            </div>
            <div class="d-flex flex-row align-items-center justify-content-center mt-4">
                <p>&copy; 2023 Que guay!. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>
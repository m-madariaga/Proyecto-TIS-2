@extends('layouts.argon.auth')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
@endsection


@section('content')
<main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-color:hotpink; background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <a class="navbar-brand m-0" href="{{ route('home-landing') }}">
                        <img src="{{ asset('argon/assets/img/logo.png') }}" class="navbar-brand-img logo-img mb-2 mt-6" alt="main_logo" id="imgchange_logo">
                        <span class="ms-1 font-weight-bold"></span>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Regístrate</h5>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3 col-12">

                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" aria-label="Name" placeholder="Nombre" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3 col-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico" aria-label="Email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="col-md-6 mb-3 col-12">
                                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" aria-label="phone_number" placeholder="Teléfono" autofocus maxlength="10">
                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3 col-12">
                                    <input id="run" type="text" class="form-control @error('run') is-invalid @enderror" name="run" value="{{ old('run') }}" required autocomplete="run" aria-label="Run" placeholder="Run" autofocus maxlength="10">
                                    @error('run')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                            </div>

                            <div class="row">

                                <!-- Include other input fields for name, email, password -->
                                <div class="col-md-6 mb-3 col-12">
                                    <label for="country">Dirección</label>
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" aria-label="address" placeholder="Dirección" autofocus>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3 col-12">
                                    <label for="country">País:</label>
                                    <select id="country" class="form-select @error('country') is-invalid @enderror" name="country_fk" required>
                                        <option value="">Seleccionar País</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3 col-12">
                                    <label for="region">Región:</label>
                                    <select id="region" class="form-select @error('region') is-invalid @enderror" name="region_fk" required>
                                        <option value="">Seleccionar Región</option>
                                        @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('region')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3 col-12">
                                    <label for="city">Ciudad:</label>
                                    <select id="city" class="form-select @error('city') is-invalid @enderror" name="city_fk" required>
                                        <option value="">Seleccionar Ciudad</option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6 mb-3 col-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3 col-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme contraseña">
                                </div>

                            </div>


                            <div class="form-check form-check-info text-start">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Estoy de acuerdo con <a href="#" class="text-dark font-weight-bolder" id="mostrar-modal">Términos y Condiciones</a>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Registrarse</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Iniciar sesión</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- MODAL TERMINOS Y CONDICIONES -->
<div id="modal-terminos" class="modal">
    <div class="modal-content">
        <h4>Términos y Condiciones</h4>
        <p>Aquí van tus términos y condiciones.</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
</div>



@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modals = document.querySelectorAll('.modal');
        M.Modal.init(modals);
    });
</script>
<script>
    $(document).ready(function() {

        $('#country').on('change', function() {
            var countryId = $(this).val();


            $('#region').empty().append('<option value="">Seleccionar Región</option>');
            $('#city').empty().append('<option value="">Seleccionar Ciudad</option>');


            $.ajax({
                url: '/regions/' + countryId,
                type: 'GET',
                success: function(response) {

                    $.each(response, function(key, value) {
                        $('#region').append('<option value="' + value.id + '">' +
                            value.name + '</option>');
                    });
                }
            });
        });


        $('#region').on('change', function() {
            var regionId = $(this).val();


            $('#city').empty().append('<option value="">Seleccionar Ciudad</option>');


            $.ajax({
                url: '/cities/' + regionId,
                type: 'GET',
                success: function(response) {

                    $.each(response, function(key, value) {
                        $('#city').append('<option value="' + value.id + '">' +
                            value.name + '</option>');
                    });
                }
            });
        });
    });
</script>


@endsection
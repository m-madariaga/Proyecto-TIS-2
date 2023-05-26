@extends('layouts.argon.app')

@section('title')
{{ 'Profile' }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
</ol>
<h6 class="text-white font-weight-bolder ms-2">Profile</h6>
@endsection


@section('css')
@endsection

@section('content')
<div class="card shadow-lg mx-4 card-profile-top">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="/argon/assets/img/images-profile/{{ Auth::user()->imagen }}" alt="profile_image" id="profile_image" class="border-radius-lg shadow-sm img-thumbnail" style="width: 40%;">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ Auth::user()->name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{-- Public Relations --}}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="ni ni-email-83"></i>
                                <span class="ms-2">Messages</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Profile</p>
                        <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#editModal">Edit Profile</button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm">User Information</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <span class="form-control">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 d-flex justify-content-center">
                            <label for="profile_image" class="form-control-label">Porfile imagen</label>
                            <span>
                                <img src="/argon/assets/img/images-profile/{{ Auth::user()->imagen }}" alt="profile_image" id="profile_image" class="border-radius-lg shadow-sm img-thumbnail" style="width: 15%;">
                            </span>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="run" class="form-control-label">Run</label>
                                <span class="form-control">{{ Auth::user()->run }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-control-label">Email</label>
                                <span class="form-control">{{ Auth::user()->email }}</span>
                            </div>
                        </div>

                    </div>

                    <hr class="horizontal dark">

                    <p class="text-uppercase text-sm">Address Information</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="form-control-label">Address</label>
                                <span class="form-control">{{ Auth::user()->address }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country" class="form-control-label">Country</label>
                                <span class="form-control">{{ Auth::user()->country_fk }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region" class="form-control-label">Region</label>
                                <span class="form-control">{{ Auth::user()->region_fk }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city" class="form-control-label">City</label>
                                <span class="form-control">{{ Auth::user()->city_fk }}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Account information</p>
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <span class="form-control">**************</span>
                            </div>

                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="button" class="form-control-label"></label>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#editPasswordModal">Update password</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>


        <!-- MODAL --><div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('profile_edit', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p class="text-uppercase text-sm">User Information</p>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Auth::user()->name }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="profile_image" class="form-control-label">Profile Image</label>
                                <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="profile_image" name="profile_image">
                                @error('profile_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="run" class="form-control-label">Run</label>
                                <input type="text" class="form-control @error('run') is-invalid @enderror" id="run" name="run" value="{{ Auth::user()->run }}" required>
                                @error('run')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email" class="form-control-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->email }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="address" class="form-control-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ Auth::user()->address }}" required>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="country" class="form-label">Country</label>
                                <select id="country" class="form-control @error('country_fk') is-invalid @enderror" name="country_fk" required>
                                    <option value="">{{ Auth::user()->country_fk }}</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_fk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="region">Región:</label>
                                <select id="region" class="form-select @error('region_fk') is-invalid @enderror" name="region_fk" required>
                                    <option value="">{{ Auth::user()->region_fk }}</option>
                                    @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                                @error('region_fk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="city">Ciudad:</label>
                                <select id="city" class="form-select @error('city_fk') is-invalid @enderror" name="city_fk" required>
                                    <option value="">{{ Auth::user()->city_fk }}</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_fk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-sm btn-outline-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


        <!-- FIN MODAL -->




        <!-- MODAL PARA EDITAR CONTRASEÑA -->
        <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileLandingModalLabel">Update Password</h5>
                    </div>

                    <form method="POST" action="{{ route('change_password_landing') }}">
                        @csrf
                        <div class="modal-body">
                            <p class="text-uppercase text-sm" id="profile_title">User Information</p>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="current_password" class="form-control-label">{{ __('Contraseña Actual') }}</label>
                                    <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autofocus>
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password" class="form-control-label ">{{ __('Nueva Contraseña') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password-confirm" class="form-control-label">{{ __('Confirmar Contraseña') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-outline-success">Save changes</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function() {


        $('#editModal').on('show.bs.modal', function() {
            // Do something when the modal is shown
        });

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
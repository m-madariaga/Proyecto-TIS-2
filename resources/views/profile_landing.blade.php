@extends('layouts-landing.welcome')

@section('css')

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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

@section('content')
<div class="container py-4 mb-4" style="margin-top: 12rem;">
    <div class="row">
        <div class="col-md-7 col-12">
            <div class="card">
                <div class="card-header pb-0 text-center text-md-start" id="profile_card_header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">{{ __('Profile') }}</h4>

                        </div>
                        <div class="d-flex align-items-center">
                            <button class="button_edit_profile btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#editProfileLandingModal">Edit Profile</button>
                        </div>
                    </div>
                </div>
                <hr class="mt-4 mx-3 my-0"> <!-- Línea separadora -->
                <div class="card-body" id="profile_card_body">
                    <!-- User Information -->
                    <p class="text-uppercase text-sm" id="profile_title">User Information</p>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <span class="form-control" id="profile_card_body">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 d-flex justify-content-center">
                            <img src="assets/images/images-profile/{{ Auth::user()->imagen }}" alt="profile_image" id="profile_image" class="border-radius-lg shadow-sm img-thumbnail" style="width: 40%;">
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="run" class="form-label">Run</label>
                                <span class="form-control" id="profile_card_body">{{ Auth::user()->run }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <span class="form-control" id="profile_card_body">{{ Auth::user()->email }}</span>
                            </div>
                        </div>

                    </div>
                    <hr class="horizontal dark">
                    <!-- Contact Information -->
                    <p class="text-uppercase text-sm" id="profile_title">Contact Information</p>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <span class="form-control" id="profile_card_body">{{ Auth::user()->address }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="country" class="form-label">Country</label>
                                <span class="form-control" id="profile_card_body">{{ Auth::user()->country_fk }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="region" class="form-label">Region</label>
                                <span class="form-control" id="profile_card_body">{{ Auth::user()->region_fk }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="city" class="form-label">City</label>
                                <span class="form-control" id="profile_card_body">{{ Auth::user()->city_fk }}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">
                    <!-- Password -->
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="text-uppercase text-sm" id="profile_title">Password</p>

                    </div>
                    <div class="row">
                        <div class="col-md-7 col-12">
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="form-label">Password</label>
                                    <span class="form-control ml-4" id="profile_card_body">**************</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <button class="button_edit_profile btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#editPasswordLandingModal">Update password</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-5 col-12">
            <div class="card">
                <div class="card-header" id="profile_card_header">
                    <h4 class="mb-0 fw-bold">{{ __('Shopping history') }}</h4>
                </div>
                <div class="card-body">
                    <!-- Segundo formulario -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal EDITAR PERFIL -->
<div class="modal fade" id="editProfileLandingModal" tabindex="-1" aria-labelledby="editProfileLandingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLandingModalLabel">Edit Profile</h5>
            </div>

            <form method="POST" action="{{ route('profile_landing_edit', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p class="text-uppercase text-sm" id="profile_title">User Information</p>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control input-field @error('name') is-invalid @enderror" name="name" id="profile_card_body" value="{{ Auth::user()->name }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="run" class="form-label">Run</label>
                                <input type="text" class="form-control input-field @error('run') is-invalid @enderror" name="run" value="{{ Auth::user()->run }}" required>
                                @error('run')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="profile_card_body" value="{{ Auth::user()->email }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm" id="profile_title">Contact Information</p>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control input-field @error('address') is-invalid @enderror" name="address" value="{{ Auth::user()->address }}" required>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="region" class="form-label">Region</label>
                                <select id="text" class="form-control input-field @error('region_fk') is-invalid @enderror" name="region_fk" required>
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
                                <label for="city" class="form-label">City</label>
                                <select id="text" class="form-control input-field @error('city_fk') is-invalid @enderror" name="city_fk" required>
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
                                <label for="profile_image" class="form-label">Profile Image</label>
                                <input type="file" class="form-control input-field @error('profile_image') is-invalid @enderror" name="profile_image">
                                @error('profile_image')
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
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- END MODAL -->


<!-- MODAL PARA EDITAR CONTRASEÑA -->
<div class="modal fade" id="editPasswordLandingModal" tabindex="-1" aria-labelledby="editProfileLandingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLandingModalLabel">Edit Profile</h5>
            </div>

            <form method="POST" action="{{route('profile_landing_edit', ['id' => Auth::user()->id])}}">
                @csrf
                <div class="modal-body">
                    <p class="text-uppercase text-sm" id="profile_title">User Information</p>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Ingrese Password Actual</label>
                                <input type="text" class="form-control input-field @error('name') is-invalid @enderror" name="name" id="profile_card_body" value="" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <hr class="horizontal dark">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="run" class="form-label">Password nueva</label>
                                <input type="text" class="form-control input-field @error('run') is-invalid @enderror" value="" required>
                                @error('run')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Confirme Password </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="profile_card_body" value="" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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
@endsection
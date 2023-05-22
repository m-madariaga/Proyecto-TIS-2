@extends('layouts-landing.welcome')

@section('css')

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="container py-4 mb-4" style="margin-top: 12rem;">
    <div class="row">
        <div class="col-md-7 col-12">
            <div class="card">
                <div class="card-header pb-0 text-center text-md-start" id="profile_card_header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 fw-bold">{{ __('Profile') }}</h4>
                        <button class="button_edit_profile btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#editProfileLandingModal">Edit Profile</button>
                    </div>
                </div>
                <div class="card-body" id="profile_card_body">
                    <!-- Primer formulario -->
                    <p class="text-uppercase text-sm" id="profile_title">User Information</p>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="profile_card_body" value="{{ Auth::user()->name }}" required>
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
                                <input type="text" class="form-control  @error('run') is-invalid @enderror" id="profile_card_body" value="{{ Auth::user()->run }}" required>
                                @error('run')
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
                                <input type="text" class="form-control" id="profile_card_body" value="{{ Auth::user()->address }}" required>
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
                                <input type="text" class="form-control" id="profile_card_body" value="{{ Auth::user()->country_fk }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="region" class="form-label">Region</label>
                                <input type="text" class="form-control" id="profile_card_body" value="{{ Auth::user()->region_fk }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="profile_card_body" value="{{ Auth::user()->city_fk }}" required>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">

                    <p class="text-uppercase text-sm" id="profile_title">Account information</p>
                    <div class="row">
                        <div class="col-md-7 col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="profile_card_body" value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="profile_card_body" required>
                            </div>
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

<!-- Modal -->
<div class="modal fade" id="editProfileLandingModal" tabindex="-1" aria-labelledby="editProfileLandingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLandingModalLabel">Edit Profile</h5>
            </div>

            <form action="">
                <div class="modal-body">
                    <p class="text-uppercase text-sm" id="profile_title">User Information</p>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control input-field @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" required>
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
                                <input type="text" class="form-control input-field @error('run') is-invalid @enderror" value="{{ Auth::user()->run }}" required>
                                @error('run')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm" id="profile_title">Contact informacion</p>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control input-field" value="{{ Auth::user()->address }}" required>
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
                    </div>

                    <hr class="horizontal dark">

                    <p class="text-uppercase text-sm" id="profile_title">Account information</p>
                    <div class="row">
                        <div class="col-md-7 col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="profile_card_body" value="{{ Auth::user()->email }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="profile_card_body" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
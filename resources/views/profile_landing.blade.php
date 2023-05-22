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
                <div class="card-body">
                    <!-- Primer formulario -->
                    <p class="text-uppercase text-sm">User Information</p>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Name</label>
                                <span class="form-control">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Run</label>
                                <span class="form-control">{{ Auth::user()->run }}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">

                    <p class="text-uppercase text-sm">Contact Information</p>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Address</label>
                                <span class="form-control">{{ Auth::user()->address }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="example-text" class="form-control-label">Country</label>
                                <span class="form-control">{{ Auth::user()->country_fk }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Region</label>
                                <span class="form-control">{{ Auth::user()->region_fk }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">City</label>
                                <span class="form-control">{{ Auth::user()->city_fk }}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Account information</p>
                    <div class="row">
                        <div class="col-md-7 col-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email</label>
                                <span class="form-control">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Password</label>
                                <span class="form-control">**************</span>
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



            </form>
            <div class="modal-body">
                <p class="text-uppercase text-sm">User Information</p>
                
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" required>
                            </div>

                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">run</label>
                                <input type="text" class="form-control" id="name" value="{{ Auth::user()->run }}" required>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Contact informacion</p>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" value="{{ Auth::user()->address }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" value="{{ Auth::user()->country }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Region</label>
                                <input type="text" class="form-control" id="region" value="{{ Auth::user()->region }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" value="{{ Auth::user()->city }}" required>
                            </div>
                        </div>
                        <!-- <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">-->
                    </div>

                    <hr class="horizontal dark">

                    <p class="text-uppercase text-sm">Account information</p>

                    <div class="row">
                        <div class="col-md-7 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" value="{{ Auth::user()->password }}" required>
                            </div>
                        </div>
                    </div>

                    </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-sm btn-outline-success">Save changes</button>
        </div>
                
            </div>
       
    </div>
</div>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


@endsection
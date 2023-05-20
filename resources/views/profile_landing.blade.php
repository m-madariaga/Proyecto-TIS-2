@extends('layouts-landing.welcome')

@section('css')

@endsection

@section('js')

@endsection

@section('content')
<div class="container py-4 mb-4">
    <div class="row">
        <div class="col-md-7 col-12">
            <div class="card">
                <div class="card-header pb-0 text-center text-md-start" id="profile_card_header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 fw-bold">{{ __('Profile') }}</h4>
                        <button class="button_edit_profile btn btn-primary btn-sm btn-rounded">Edit Profile</button>
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
                                <label for="example-text-input" class="form-control-label">City</label>
                                <span class="form-control">{{ Auth::user()->city_fk }}</span>
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

@endsection
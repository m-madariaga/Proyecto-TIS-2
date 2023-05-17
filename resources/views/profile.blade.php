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
                    <img src="/argon/assets/img/team-1.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
                @foreach ($users as $user)
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Profile</p>
                        <button class="btn btn-primary btn-sm ms-auto">Edit Profile</button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm">User Information</p>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Name</label>
                                <span class="form-control">{{$user->name}}</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Run</label>
                                <span class="form-control">11.111.111-1</span>
                            </div>
                        </div>

                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Contact Information</p>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Address</label>
                                <span class="form-control">Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">City</label>
                                <span class="form-control">Concepcion</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text" class="form-control-label">Country</label>
                                <span class="form-control">Chile</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Region</label>
                                <span class="form-control">Bio Bio</span>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Account information</p>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email</label>
                                <span class="form-control">corre</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Password</label>
                                <span class="form-control" type="password" value="jesse@example.com">*********</span>
                            </div>
                        </div>

                    </div>

                </div>
                @endforeach
            </div>

        </div>

    </div>
</div>
@endsection

@section('js')
@endsection
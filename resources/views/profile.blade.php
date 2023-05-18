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

                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Profile</p>
                        <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#editModal">Edit Profile</button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm">User Information</p>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Name</label>
                                <span class="form-control">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Run</label>
                                <span class="form-control">{{ Auth::user()->run }}</span>
                            </div>
                        </div>

                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Contact Information</p>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Address</label>
                                <span class="form-control">{{ Auth::user()->address }}</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">City</label>
                                <span class="form-control">{{ Auth::user()->city_fk }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text" class="form-control-label">Country</label>
                                <span class="form-control">{{ Auth::user()->country_fk }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Region</label>
                                <span class="form-control">{{ Auth::user()->region_fk }}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Account information</p>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email</label>
                                <span class="form-control">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Password</label>
                                <span class="form-control">**************</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>


        <!-- MODAL -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="">
                        @csrf

                        <div class="modal-body">

                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Auth::user()->name }}" required>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Run</label>
                                        <input type="text" class="form-control @error('run') is-invalid @enderror" id="run" name="run" value="{{ Auth::user()->run }}" required>

                                        @error('run')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Contact Information</p>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="text-center">
                                            <label for="example-text-input" class="form-control-label">Address</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ Auth::user()->address }}" required>

                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="city">Ciudad:</label>
                                            <select id="city" class="form-select @error('city') is-invalid @enderror" name="city_fk" required>
                                                <option value="">Seleccionar Ciudad</option>

                                                <option value="{{ Auth::user()->city_fk}}"></option>

                                            </select>

                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">País:</label>
                                            <select id="country" class="form-select @error('country') is-invalid @enderror" name="country_fk" required>
                                                <option value="">Seleccionar País</option>

                                                <option value="{{Auth::user()->country_fk }}"></option>

                                            </select>

                                            @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="region">Región:</label>
                                            <select id="region" class="form-select @error('region') is-invalid @enderror" name="region_fk" required>
                                                <option value="">Seleccionar Región</option>


                                                <option value="{{ Auth::user()->region_fk}}"></option>

                                            </select>

                                            @error('region')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Account information</p>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->email }}" required>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Password</label>
                                            <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password" value="{{ Auth::user()->password }}" required>

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Run</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div> -->
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
        $('#shipment_types-table').DataTable({
            dom: 'lfrtip',
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
        });

        $('#addModal').modal({
            show: false
        });

        $('#editModal').on('show.bs.modal', function() {
            // Do something when the modal is shown
        });

    });
</script>

@endsection
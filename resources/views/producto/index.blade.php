@extends('layouts.argon.app')

@section('title')
{{ 'Productos' }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Productos</li>
</ol>
<h6 class="font-weight-bolder text-white mb-0">Productos</h6>
@endsection

@section('css')
@endsection

@section('content')
<div class="container w-50 border p-4 mt-4">
    <h1> Productos</h1>

    <div class=''>

        <table id='tabla' class="hover nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                    <th>Color</th>
                    <th>Talla</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            @if(isset($empty))

            @else
            <tbody>
                @foreach ($productos as $prod)
                <tr>
                    <td>{{ $prod->id}}</td>
                    <td>{{ $prod->nombre}}</td>
                    <td>
                        @foreach ($marcas as $marca)
                            @if ($prod->marca_id == $marca->id)
                                
                            @endif
                        @endforeach
                        {{ $prod->marca_id->nombre}}
                    </td>
                    <td>{{ $tablet->Precio}}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('tablets-edit', ['id'=> $tablet->id]) }}">Editar tablet</a>
                        <form action="{{ route('tablets-destroy', [$tablet->id]) }}" class="formulario-eliminar" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>
    </div>
</div>





<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Authors table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Author</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Function</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Employed</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/argon/assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">John Michael</h6>
                                                <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                                        <p class="text-xs text-secondary mb-0">Organization</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Online</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/argon/assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Alexa Liras</h6>
                                                <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/argon/assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                                                <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Executive</p>
                                        <p class="text-xs text-secondary mb-0">Projects</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Online</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/argon/assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user4">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Michael Levi</h6>
                                                <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Online</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/argon/assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user5">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Richard Gran</h6>
                                                <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                                        <p class="text-xs text-secondary mb-0">Executive</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/argon/assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user6">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Miriam Eric</h6>
                                                <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Programtor</p>
                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Projects table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Project</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Budget</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Completion</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="/argon/assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Spotify</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$2,500</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">working</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">60%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="/argon/assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm rounded-circle me-2" alt="invision">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Invision</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$5,000</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">done</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">100%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="/argon/assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2" alt="jira">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Jira</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$3,400</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">canceled</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">30%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="/argon/assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm rounded-circle me-2" alt="slack">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Slack</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$1,000</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">canceled</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">0%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="/argon/assets/img/small-logos/logo-webdev.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Webdev</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$14,000</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">working</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">80%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="/argon/assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm rounded-circle me-2" alt="xd">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Adobe XD</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$2,300</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">done</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">100%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success') == 'Tablet Ingresada')

<script>
    Swal.fire(
        'Tablet Ingresado!',
        'Sus datos han sido ingresados exitosamente.',
        'success'
    )
</script>
@endif

@if (session('success') == 'Tablet Eliminada')

<script>
    Swal.fire(
        'Eliminado!',
        'Su archivo ha sido eliminado.',
        'success'
    )
</script>
@endif

<script>
    $('.formulario-eliminar').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estas seguro que desea eliminar?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>
@endsection
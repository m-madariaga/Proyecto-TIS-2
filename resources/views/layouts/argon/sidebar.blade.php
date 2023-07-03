<head>
    <style>
        .hr {
            margin-top: -4rem;
        }
    </style>
</head>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main" style="overflow-y: auto;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('admin_home') }}" target="_blank">
            <img src="{{ asset('argon/assets/img/logo.png') }}" class="navbar-brand-img" alt="main_logo"
                id="imgchange_logo">
            <span class="ms-1 font-weight-bold"></span>
            <span></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @can('dashboard')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}" href="{{ route('admin_home') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#collapseMantenedores1" role="button"
                    aria-expanded="false" aria-controls="collapseMantenedores1">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuarios/Personal</span>
                </a>
                <div class="collapse" id="collapseMantenedores1">
                    <ul class="navbar-nav">
                        @can('mantenedor permisos')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/permissions') ? 'active' : '' }}"
                                    href="{{ route('permissions.index') }}">
                                    <span class="nav-link-text ms-3">Permisos</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor roles')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }}"
                                    href="{{ route('roles.index') }}">
                                    <span class="nav-link-text ms-3">Roles</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor usuarios')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}"
                                    href="{{ route('users.index') }}">
                                    <span class="nav-link-text ms-3">Usuarios</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#collapseMantenedores2" role="button"
                    aria-expanded="false" aria-controls="collapseMantenedores2">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ubicaciones</span>
                </a>
                <div class="collapse" id="collapseMantenedores2">
                    <ul class="navbar-nav">
                        @can('mantenedor ciudades')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/cities') ? 'active' : '' }}"
                                    href="{{ route('cities.index') }}">
                                    <span class="nav-link-text ms-3">Ciudades</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor paises')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/countries') ? 'active' : '' }}"
                                    href="{{ route('countries.index') }}">
                                    <span class="nav-link-text ms-3">Países</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor regiones')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/regions') ? 'active' : '' }}"
                                    href="{{ route('regions.index') }}">
                                    <span class="nav-link-text ms-3">Regiones</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#collapseMantenedores3" role="button"
                    aria-expanded="false" aria-controls="collapseMantenedores3">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-truncate">Tienda</span>
                </a>
                <div class="collapse" id="collapseMantenedores3">
                    <ul class="navbar-nav">
                        @can('mantenedor categorias')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/categorias') ? 'active' : '' }}"
                                    href="{{ route('categorias') }}">
                                    <span class="nav-link-text ms-3">Categorías</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor marcas')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/marcas') ? 'active' : '' }}"
                                    href="{{ route('marcas') }}">
                                    <span class="nav-link-text ms-3">Marcas</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor productos')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/productos') ? 'active' : '' }}"
                                    href="{{ route('productos') }}">
                                    <span class="nav-link-text ms-3">Productos</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor productos deseados')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/productos_deseados') ? 'active' : '' }}"
                                    href="{{ route('product_desired') }}">
                                    <span class="nav-link-text ms-3">Productos deseados</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#collapseMantenedores4" role="button"
                    aria-expanded="false" aria-controls="collapseMantenedores4">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-truncate">Gestion Ventas e Inventario</span>
                </a>
                <div class="collapse" id="collapseMantenedores4">
                    <ul class="navbar-nav">
                        @can('mantenedor webpay')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/webpay') ? 'active' : '' }}"
                                    href="{{ route('webpaycredentials.index') }}">
                                    <span class="nav-link-text ms-3 text-truncate">Credenciales Webpay</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor datos transferencia')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}"
                                    href="{{ route('databanktransfer.index') }}">
                                    <span class="nav-link-text ms-3 text-truncate">Datos Transferencia Bancaria</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor envio')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/shipments') ? 'active' : '' }}"
                                    href="{{ route('shipments.index') }}">
                                    <span class="nav-link-text ms-3">Envíos</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor metodo pago')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}"
                                    href="{{ route('paymentmethod.index_admin') }}">
                                    <span class="nav-link-text ms-3">Métodos de Pago</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor ordenes')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/orden-compra') ? 'active' : '' }}"
                                    href="{{ route('orden-compra') }}">
                                    <span class="nav-link-text ms-3 text-truncate">Órdenes de compra</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor envio')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}"
                                    href="{{ route('orders.index') }}">
                                    <span class="nav-link-text ms-3">Pedidos</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor punto de venta')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}"
                                    href="{{ route('point_of_sale') }}">
                                    <span class="nav-link-text ms-3">Punto de venta</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor tipo envio')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/shipment_types') ? 'active' : '' }}"
                                    href="{{ route('shipment_types.index') }}">
                                    <span class="nav-link-text ms-3">Tipos de envío</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor documentos transferencia')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/documentos') ? 'active' : '' }}"
                                    href="{{route('documents.index')}}">
                                    <span class="nav-link-text ms-3 text-truncate">Comprobantes transferencia</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#collapseMantenedores5" role="button"
                    aria-expanded="false" aria-controls="collapseMantenedores5">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-truncate">Gestión página Web</span>
                </a>
                <div class="collapse" id="collapseMantenedores5">
                    <ul class="navbar-nav">
                        @can('mantenedor preguntas')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}"
                                    href="{{ route('preguntas') }}">
                                    <span class="nav-link-text ms-3 text-truncate">Preguntas Frecuentes</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor promociones')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}"
                                    href="{{ route('promotion') }}">
                                    <span class="nav-link-text ms-3 text-truncate">Promociones</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor reviews')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}"
                                    href="{{ route('reviews.index') }}">
                                    <span class="nav-link-text ms-3">Reseñas</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor respuestas')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}"
                                    href="{{ route('respuestas') }}">
                                    <span class="nav-link-text ms-3 text-truncate">Respuestas</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenedor secciones landing')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}"
                                    href="{{ route('section.index') }}">
                                    <span class="nav-link-text ms-3 text-truncate">Vista Cliente</span>
                                </a>
                            </li>
                        @endcan

                        
                        
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#collapseMantenedores8" role="button"
                    aria-expanded="false" aria-controls="collapseMantenedores8">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-truncate">Gestión Administrador</span>
                </a>
                <div class="collapse" id="collapseMantenedores8">
                    <ul class="navbar-nav">
                        @can('mantenedor acciones')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}"
                                    href="{{ route('actions.index') }}">
                                    <span class="nav-link-text ms-3">Acciones Realizadas</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </div>
            </li>

        </ul>
    </div>
</aside>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main" style="overflow-y: auto;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('admin_home') }}" target="_blank">
            <img src="{{ asset('argon/assets/img/logo.png') }}" class="navbar-brand-img" alt="main_logo" id="imgchange_logo">
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
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @endcan
            {{-- <hr class="horizontal dark my-sm-4">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('tables') ? 'active' : '' }}" href="{{ route('tables') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-folder-17 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Tables</span>
            </a>
            </li> --}}
            <hr class="horizontal dark my-sm-4">
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#collapseMantenedores" role="button" aria-expanded="false" aria-controls="collapseMantenedores">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mantenedores</span>
                </a>
                <div class="collapse" id="collapseMantenedores">
                    <ul class="navbar-nav">
                        @can('mantenedor usuarios')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                <span class="nav-link-text ms-3">Usuarios</span>
                            </a>
                        </li>
                        @endcan
                        @can('mantenedor roles')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                                <span class="nav-link-text ms-3">Roles</span>
                            </a>
                        </li>
                        @endcan
                        @can('mantenedor permisos')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/permissions') ? 'active' : '' }}" href="{{ route('permissions.index') }}">
                                <span class="nav-link-text ms-3">Permisos</span>
                            </a>
                        </li>
                        @endcan
                        @can('mantenedor productos')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/productos') ? 'active' : '' }}" href="{{ route('productos') }}">
                                <span class="nav-link-text ms-3">Productos</span>
                            </a>
                        </li>
                        @endcan
                        @can('mantenedor productos deseados')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/productos_deseados') ? 'active' : '' }}" href="{{ route('product_desired') }}">
                                <span class="nav-link-text ms-3">Productos deseados</span>
                            </a>
                        </li>
                        @endcan
                        @can('mantenedor categorias')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/categorias') ? 'active' : '' }}" href="{{ route('categorias') }}">
                                <span class="nav-link-text ms-3">Categorías</span>
                            </a>
                        </li>
                        @endcan
                        @can('mantenedor marcas')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/marcas') ? 'active' : '' }}" href="{{ route('marcas') }}">
                                <span class="nav-link-text ms-3">Marcas</span>
                            </a>
                        </li>
                        @endcan
                        @can('mantenedor paises')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/countries') ? 'active' : '' }}" href="{{ route('countries.index') }}">
                                <span class="nav-link-text ms-3">Países</span>
                            </a>
                        </li>
                        @endcan
                        @can('mantenedor regiones')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/regions') ? 'active' : '' }}" href="{{ route('regions.index') }}">
                                <span class="nav-link-text ms-3">Regiones</span>
                            </a>
                        </li>
                        @endcan
                        @can('mantenedor ciudades')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/cities') ? 'active' : '' }}" href="{{ route('cities.index') }}">
                                <span class="nav-link-text ms-3">Ciudades</span>
                            </a>
                        </li>
                        @endcan
                        @can('mantenedor envio')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/shipments') ? 'active' : '' }}" href="{{ route('shipments.index') }}">
                                <span class="nav-link-text ms-3">Envíos</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>

            </li>
            @can('mantenedor ordenes')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/orden-compra') ? 'active' : '' }}" href="{{ route('orden-compra') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-truncate">Ordenes de compra</span>
                </a>
            </li>
            @endcan
            @can('mantenedor tipo envio')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/shipment_types') ? 'active' : '' }}" href="{{ route('shipment_types.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tipos de envío</span>
                </a>
            </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('calendar') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Calendario</span>
                </a>
            </li>

            @can('mantenedor envio')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pedidos</span>
                </a>
            </li>
            @endcan

            @can('mantenedor metodo pago')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('paymentmethod.index_admin') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Métodos de Pago</span>
                </a>
            </li>
            @endcan

            @can('mantenedor datos transferencia')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('databanktransfer.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-truncate">Datos Transferencia Bancaria</span>
                </a>
            </li>
            @endcan

            @can('mantenedor webpay')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/webpay') ? 'active' : '' }}" href="{{ route('webpaycredentials.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-truncate">Credenciales Webpay</span>
                </a>
            </li>
            @endcan

            @can('mantenedor reviews')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('reviews.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Reseñas</span>
                </a>
            </li>
            @endcan
            @can('mantenedor punto de venta')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('point_of_sale') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Punto de venta</span>
                </a>
            </li>
            @endcan
            @can('mantenedor acciones')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('actions.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Acciones Realizadas</span>
                    </a>
                </li>
            @endcan
            @can('mantenedor secciones landing')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('section.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1 text-truncate">Vista Cliente</span>
                    </a>
                </li>
            @endcan
            @can('mantenedor promociones')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('promotion') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1 text-truncate">Promociones</span>
                    </a>
                </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('actions.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Acciones Realizadas</span>
                </a>
            </li>
            @endcan

            @can('mantenedor preguntas')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('preguntas') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-truncate">Preguntas Frecuentes </span>
                </a>
            </li>
            @endcan
            @can('mantenedor respuestas')
            <li class="nav-item">
            <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('respuestas') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-truncate">Respuestas</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</aside>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="{{ asset('argon/assets/img/logo.png') }}" class="navbar-brand-img " alt="main_logo"
                id="imgchange_logo">
            <span class="ms-1 font-weight-bold"></span>
            <span></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">



            @can('dashboard')
                <li class="nav-item">
                    <a class="nav-link  {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endcan


            <li class="nav-item">
                <a class="nav-link {{ request()->is('tables') ? 'active' : '' }}" href="{{ route('tables') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tables</span>
                </a>
            </li>
            @can('mantenedor usuarios')
                <li class="nav-item" style="{{ request()->is('admin/*') ? '' : 'display:none' }}">
                    <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Usuarios</span>
                    </a>
                </li>
            @endcan
            @can('mantenedor ordenes')
                <li class="nav-item" style="{{ request()->is('admin/*') ? '' : 'display:none' }}">
                    <a class="nav-link {{ request()->is('admin/orden-compra') ? 'active' : '' }}"
                        href="{{ route('orden-compra') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ordenes de compra</span>
                    </a>
                </li>
            @endcan
            @can('mantenedor productos')
                <li class="nav-item" style="{{ request()->is('admin/*') ? '' : 'display:none' }}">
                    <a class="nav-link {{ request()->is('admin/productos') ? 'active' : '' }}"
                        href="{{ route('productos') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Productos</span>
                    </a>
                </li>
            @endcan

            @can('mantenedor categorias')
                <li class="nav-item" style="{{ request()->is('admin/*') ? '' : 'display:none' }}">
                    <a class="nav-link {{ request()->is('admin/categorias') ? 'active' : '' }}"
                        href="{{ route('categorias') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Categorias</span>
                    </a>
                </li>
            @endcan

            @can('mantenedor marcas')
                <li class="nav-item" style="{{ request()->is('admin/*') ? '' : 'display:none' }}">
                    <a class="nav-link {{ request()->is('admin/marcas') ? 'active' : '' }}" href="{{ route('marcas') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Marcas</span>
                    </a>
                </li>
            @endcan

            @can('mantenedor roles')
                <li class="nav-item" style="{{ request()->is('admin/*') ? '' : 'display:none' }}">
                    <a class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }}"
                        href="{{ route('roles.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Roles</span>
                    </a>
                </li>
            @endcan

            @can('mantenedor permisos')
                <li class="nav-item {{ request()->is('admin/*') ? '' : 'display:none' }}"
                    style="{{ request()->is('admin/*') ? '' : 'display:none' }}">
                    <a class="nav-link {{ request()->is('admin/permissions') ? 'active' : '' }}"
                        href="{{ route('permissions.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Permisos</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link {{ request()->is('page') ? 'active' : '' }}" href="{{ route('calendar') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Calendar</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
    </div>
</aside>

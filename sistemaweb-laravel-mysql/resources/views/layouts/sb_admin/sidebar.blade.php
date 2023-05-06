<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion"> <!-- sb-sidenav-dark -->

        <!-- SIDEBAR MENU -->
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- CORE -->
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Dashboard
                </a>

                <!-- INTERFACE -->
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAlmacen"
                    aria-expanded="false" aria-controls="collapseAlmacen">
                    <div class="sb-nav-link-icon"><i class="fas fa-laptop"></i></div> Almacen
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAlmacen" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('articulo.index') }}">Artículos</a>
                        <a class="nav-link" href="{{ route('categoria.index') }}">Categorías</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompras"
                    aria-expanded="false" aria-controls="collapseCompras">
                    <div class="sb-nav-link-icon"><i class="fas fa-th"></i></div> Compras
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('ingreso.index') }}">Ingresos</a>
                        <a class="nav-link" href="{{ route('proveedor.index') }}">Proveedores</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVentas"
                    aria-expanded="false" aria-controls="collapseVentas">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div> Ventas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseVentas" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Ventas</a>
                        {{-- <a class="nav-link" href="{{ route('venta.index') }}">Ventas</a> --}}
                        <a class="nav-link" href="{{ route('cliente.index') }}">Clientes</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAcceso"
                    aria-expanded="false" aria-controls="collapseAcceso">
                    <div class="sb-nav-link-icon"><i class="fas fa-laptop"></i></div> Acceso
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAcceso" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('user.index') }}">Usuarios</a>
                        <a class="nav-link" href="{{ route('role.index') }}">Roles</a>
                        <a class="nav-link" href="{{ route('module.index') }}">Modulos</a>
                    </nav>
                </div>

                <a class="nav-link" href="ayuda.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus-square"></i></div> Ayuda
                    <span class="badge badge-danger right">PDF</span>
                </a>
                <a class="nav-link" href="acercade.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div> Acerca De...
                    <span class="badge badge-warning right">IT</span>
                </a>
            </div>
        </div>

        <!-- SIDEBAR FOOTER -->
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
            @foreach (Auth::user()->roles as $key=>$role)
                ( {{ $role->name }} )
            @endforeach
        </div>

    </nav>
</div>
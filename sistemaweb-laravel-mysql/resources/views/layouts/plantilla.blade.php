@include('layouts.sb_admin.header')

<body class="sb-nav-fixed">
    @include('layouts.sb_admin.menu')
    <div id="layoutSidenav">
        @include('layouts.sb_admin.sidebar')
        <div id="layoutSidenav_content">
            <main>
                @yield('contenido')
            </main>
            @include('layouts.sb_admin.footer')
        </div>
    </div>
    @include('layouts.sb_admin.scripts')
    @yield('scripts')
</body>

</html>
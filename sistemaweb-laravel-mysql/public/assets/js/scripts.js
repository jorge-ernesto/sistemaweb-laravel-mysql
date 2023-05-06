/*!
    * Start Bootstrap - SB Admin v6.0.0 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
    */
(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    
        //CONFIGURACION PARA OBTENER URL EN LARAVEL
        var pathsplit = path.split('/');
        var path1 = pathsplit[0] + '/'+ pathsplit[1] + '/' + pathsplit[2] + '/' + pathsplit[3];
        var path2 = pathsplit[0] + '/'+ pathsplit[1] + '/' + pathsplit[2] + '/' + pathsplit[3] + '/' + pathsplit[4];
        console.log(path1);
        console.log(path2);
        //CERRAR CONFIGURACION PARA OBTENER URL EN LARAVEL

        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path1 || this.href === path2) {
                $(this).addClass("active");

                //CONFIGURACION PARA QUE EL ELEMENTO PADRE DEL ENLACE SE EXPANDA
                var parent = $(this).parents('div.collapse');
                parent.addClass('collapse show');
                //CERRAR CONFIGURACION PARA QUE EL ELEMENTO PADRE DEL ENLACE SE EXPANDA
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

$(document).ready(function() {
    $("#listaUsuarios").DataTable({
        scrollCollapse: true,
        paging: false,
        language: { url: "admin_componentes/es-ar.json" },

        ajax: {
            url: "/api/Users",
            dataSrc: '',
        },

        columns: [{
                defaultContent: "<a href='#' <i class='fas fa-users-cog link-inactivar' title='Inactivar/Activar' style='color: lightslategrey;'></i></a><a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Editar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
            },
            { data: "id" },
            { data: "nombre" },
            { data: "apellido" },
            { data: "email" },
            { data: "cargo" },
            { data: "modulo" },
            { data: "user" },
            {
                data: "rol",
                render: (data, type, row) => {
                    "use strict";
                    return data == 1 ?
                        "Superusuario" :
                        data == 2 ?
                        "Administrador" :
                        data == 3 ?
                        "Usuario" :
                        data == 4 ?
                        "Usuario QC" :
                        "Desarrollo";
                },
            },
            {
                data: "estado",
                render: (data, type, row) => {
                    "use strict";
                    return data == 1 ? "Activo" : "Inactivo";
                },
            },
        ],
    });
});
$(document).ready(function () {
    $("#tblCargos").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            url: '/api/Chargue',
            dataSrc: ''
        },

        "columns": [
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>", className: "centrado" },
            { "data": "id" },
            { "data": "cargo" },
        ]
    });
});
/* Cargue de Parametros de Condiciones del medio */

$(document).ready(function() {
    $("#listarDesinfectante").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            url: "/api/disinfectant",
            dataSrc: '',
        },

        "columns": [{
                title: 'No.',
                "data": null,
                className: 'uniqueClassName',
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Desinfectante',
                data: "nombre"
            },

            {
                title: "Concentracion",
                data: "concentracion",
                className: 'text-center'
            },

            {
                title: 'Acciones',
                data: 'id',
                className: 'uniqueClassName',
                render: function(data) {
                    return `<a href='#' <i id=${data} class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>
                            <a href='#' <i id=${data} class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>delete</i></a>`
                },
            },
        ]
    });
});
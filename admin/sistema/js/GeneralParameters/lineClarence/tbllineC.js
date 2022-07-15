/* Mostrar Menu seleccionado */
$('.contenedor-menu .menu a').removeAttr('style');
$('#link_despeje').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_generales').show();
/* Cargue de Parametros de Control en DataTable */

    $("#tblDespeje").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            url: "/api/lines",
            dataSrc: '',
        },

        "columns": [
            {
                title: 'No.',
                "data": null,
                className: 'uniqueClassName',
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: "Pregunta",
                data: "pregunta"
            },
            {
                title: "Respuesta",
                data: "resp",
                className: "centrado",
                render: (data, type, row) => {
                    'use strict';
                    return data == 1 ? 'Si' : 'No';
                }
            },
            {
                title: "Modulo",
                data: "modulo"
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

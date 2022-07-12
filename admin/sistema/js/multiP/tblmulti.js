/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link_multipresentacion').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_productos').show();

/* Cargue de Multipresentacion en DataTable */


    $("#tblMulti").DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            url: "/api/adminMulti",
            dataSrc: ''
        },

        //Tabla completamente funcional, verificar si el boton de eliminar en este apartado si apliica o si es solo del otro php

        "columns": [{
            title: 'No.',
            "data": null,
            className: 'uniqueClassName',
            "render": function(data, type, full, meta) {
                return meta.row + 1;
            }
            },
            {
                data: "referencia",
                title: 'Referencia'
            },
            {
                data: "nombre_referencia",
                title: 'Nombre de referencia'
            },
            {
                title: "Multipresentacion",
                data: "multi", 
                className: "centrado" },
            ]
    });



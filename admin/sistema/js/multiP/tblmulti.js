/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link_multipresentacion').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_productos').show();

/* Cargue de Multipresentacion en DataTable */

$(document).ready(function() {
    $("#tblMulti").DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            url: "/api/multi",
            dataSrc: ''
        },

        "columns": [{
            title: 'No.',
            "data": null,
            className: 'uniqueClassName',
            "render": function(data, type, full, meta) {
                return meta.row + 1;
            }},
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
            {
                title: 'Acciones',
                data: 'multi',
                className: 'text-center',
                render: function(data) {
                    return `<a href='#' <i id=${data} class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>`
                },
            },]
    });
});


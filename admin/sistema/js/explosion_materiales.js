/* Mostrar Menu seleccionadp */
$('.contenedor-menu .menu a').removeAttr('style')
$('#link_menu_explosion').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_explosion').show()

$('#tblExplosionMaterialesBatch').dataTable({
    pageLength: 50,
    order: [
        [1, 'desc']
    ],
    dom: 'Bfrtip',
    order: [
        [0, 'asc']
    ],
    ajax: {
        url: '/api/explosionMaterialesBatch',
        dataSrc: '',
    },
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [{
            title: 'No.',
            "data": null,
            className: 'uniqueClassName',
            "render": function(data, type, full, meta) {
                return meta.row + 1;
            }
        },
        {
            title: 'Referencia',
            data: 'id_materiaprima',
        },
        {
            title: 'Materia Prima',
            data: 'nombre',
        },
        {
            title: 'Cantidad (Kg)',
            data: 'cantidad',
            className: 'uniqueClass',
            render: $.fn.dataTable.render.number('.', ',', 3)
        },
        {
            title: 'Uso (Kg)',
            data: 'uso',
            className: 'uniqueClass',
            render: $.fn.dataTable.render.number('.', ',', 3)
        },
    ],
})
$(document).ready(function() {

    $('#tablaBatchCerrados').DataTable({
        pageLength: 50,
        responsive: true,
        scrollCollapse: true,
        language: { url: '../../../admin/sistema/admin_componentes/es-ar.json' },
        oSearch: { bSmart: false },
        bAutoWidth: false,

        ajax: {
            url: '/api/batchcerrados',
            dataSrc: '',
        },
        order: [
            [0, 'desc']
        ],

        columns: [{
                title: 'Batch',
                data: 'id_batch',
                className: 'uniqueClassName',
            },
            {
                title: 'No Orden',
                data: 'numero_orden',
                className: 'uniqueClassName',
            },
            {
                title: 'Referencia',
                data: 'referencia',
                className: 'uniqueClassName',
            },
            {
                title: 'Producto',
                data: 'nombre_referencia',
            },
            {
                title: 'No Lote',
                data: 'numero_lote',
            },
            {
                title: 'Tamaño Lote',
                data: 'tamano_lote',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0, ''),
            },
            {
                title: 'Propietario',
                data: 'nombre',
            },
            {
                title: 'Fecha Planeación',
                data: 'fecha_creacion',
                className: 'uniqueClassName',
            },
            {
                title: 'Fecha Programación',
                data: 'fecha_programacion',
                className: 'uniqueClassName',
            },
        ],
    });


});
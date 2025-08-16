$(document).ready(function() {

    $('#tablaBatchCerrados').DataTable({
        pageLength: 50,
        responsive: true,
        scrollCollapse: true,
        language: { url: '../../../admin/sistema/admin_componentes/es-ar.json' },
        oSearch: { bSmart: false },
        bAutoWidth: false,

        ajax: {
            url: '/html/php/batch_cerrados_fetch.php',
            type: 'POST',
            dataSrc: 'data',
        },
        order: [
            [0, 'desc']
        ],

        columns: [{
                title: 'Batch',
                data: 0,
                className: 'uniqueClassName',
            },
            {
                title: 'Referencia',
                data: 1,
                className: 'uniqueClassName',
            },
            {
                title: 'Producto',
                data: 2,
            },
            {
                title: 'No Lote',
                data: 3,
            },
            {
                title: 'Tamaño Lote',
                data: 4,
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 2, ''),
            },
            {
                title: 'Sem Plan',
                data: 5,
                className: 'uniqueClassName',
                render: function (data) {
                    return `S${data}`;
                },
            },
            {
                title: 'Sem Prog',
                data: 6,
                className: 'uniqueClassName',
                render: function (data) {
                    return `S${data}`;
                },
            },
            {
                title: 'Fecha Programación',
                data: 7,
                className: 'uniqueClassName',
            },
            {
                title: 'Estado',
                data: 8,
                className: 'uniqueClassName',
            },
        ],
    });


});
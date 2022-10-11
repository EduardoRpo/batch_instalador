$('#tablaEnvasado').dataTable({
    pageLength: 50,
    order: [
        [1, 'desc']
    ],
    ajax: {
        url: '/api/envasado',
        dataSrc: '',
    },
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [{
            title: 'Batch',
            data: 'id_batch',
            className: 'uniqueClassName',
        },
        {
            title: 'Fecha Programación',
            data: 'programacion_envasado',
            className: 'uniqueClassName',
        },
        {
            title: 'No de Orden',
            data: 'numero_orden',
            className: 'uniqueClassName',
        },
        {
            title: 'Nombre Producto',
            data: 'referencia',
            className: 'uniqueClassName',
        },
        {
            title: 'No Lote',
            data: 'numero_lote',
            className: 'uniqueClassName',
        },
        {
            title: 'Firmas G',
            data: 'cantidad_firmas',
            className: 'uniqueClassName',
        },
        {
            title: 'Firmas T',
            data: 'total_firmas',
            className: 'uniqueClassName',
        },
        {
            title: 'Ingresar',
            className: 'uniqueClassName',
            data: '',
            render: (data, type, row) => {
                'use strict';
                return `<a href="envasadoinfo/${row.id_batch}/${row.referencia}"><i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">touch_app</i></a>`;
            },
        },
    ],
});
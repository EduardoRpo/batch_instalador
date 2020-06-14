
$('#aprobacionTable').dataTable({
    ajax: {
        url: '/api/batch',
        dataSrc: ''
    },
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
    },
    columns: [
        {
            title: 'Fecha Programación',
            data: 'fecha_programacion'
        },
        {
            title: 'No de Orden',
            data: 'numero_orden'
        },
        {
            title: 'Referencia',
            data: 'referencia'
        },
        {
            title: 'Nombre Referencia',
            data: 'nombre_referencia'
        },
        /*{
            title: 'Tamaño Lote',
            data: 'tamano_lote'
        },*/
        {
            title: 'No Lote',
            data: 'numero_lote',
            /* render: (data, type, row) => {
                'use strict';
                return $.number(data, 0, ',', '.');
            } */
        },
      /*   {
            title: 'Estado',
            data: 'estado',
            render: (data, type, row) => {
                'use strict';
                return data === 1 ? 'Activo' : 'Inactivo';
            }
        }, */
        {
            title: 'Ingresar',
            data: '',
            render: (data, type, row) => {
                'use strict';
                return `<a href="aprobacioninfo/${row.id_batch}/${row.referencia}"><i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">border_color</i></a>`;
            }
        },
    ]
});

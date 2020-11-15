$(document).ready(function () {
    $('#preparacionTabla').dataTable({
        ajax: {
            url: '/api/batch',
            dataSrc: ''
        },
        language:{
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        columns: [
            {
                title: 'Batch',
                data: "id_batch", className: 'uniqueClassName'
            },
            {
                title: 'Fecha Programación',
                data: 'fecha_programacion', className: 'uniqueClassName'
            },
            {
                title: 'No Orden',
                data: 'numero_orden', className: 'uniqueClassName'
            },
            {
                title: 'Referencia',
                data: 'referencia', className: 'uniqueClassName'
            },
            {
                title: 'No Lote',
                data: 'numero_lote', className: 'uniqueClassName'
                /* render: (data, type, row) => {
                    'use strict';
                    return $.number(data, 0, ',', '.'); 
                }*/
            },
            /*{
                title: 'Nombre Referencia',
                data: 'nombre_referencia'
            },
            {
                title: 'Tamaño Lote',
                data: 'tamano_lote'
            },*/

            /* {
                title: 'Estado',
                data: 'estado',
                render: (data, type, row) => {
                    'use strict';
                    return data === 1 ? 'Activo' : 'Inactivo';
                }
            }, */
            {
                title: 'Ingresar',
                data: '', className: 'uniqueClassName',
                render: (data, type, row) => {
                    'use strict';
                    return `<a href="preparacioninfo/${row.id_batch}/${row.referencia}"<i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">ev_station</i></a>`;
                }
            },
        ]
    })    
});
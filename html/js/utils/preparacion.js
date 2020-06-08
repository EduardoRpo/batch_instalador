$(document).ready(function () {
    $('#preparacionTabla').dataTable({
        ajax: {
            //url: '/api/batch',
            method: "POST",
            url : "html/php/listarBatch.php",
            data : {"operacion" : "1"},
            //dataSrc: ''
        },
        language:{
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        columns: [
            {
                title: 'Fecha Programación',
                data: 'fecha_programacion'
            },
            {
                title: 'No Orden',
                data: 'numero_orden'
            },
            {
                title: 'Referencia',
                data: 'referencia'
            },
            {
                title: 'No Lote',
                data: 'numero_lote',
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

            {
                title: 'Estado',
                data: 'estado',
                render: (data, type, row) => {
                    'use strict';
                    return data === 1 ? 'Activo' : 'Inactivo';
                }
            },
            {
                title: 'Ingresar',
                data: '',
                render: (data, type, row) => {
                    'use strict';
                    return `<a href="preparacioninfo/${row.id_batch}/${row.referencia}"<i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">border_color</i></a>`;
                }
            },
        ]
    })    
});
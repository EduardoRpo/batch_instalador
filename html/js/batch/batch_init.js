$(document).ready(function() {
    // Limpiar localStorage
    localStorage.removeItem('dataBatchPdf');
    localStorage.removeItem('orden');
    localStorage.removeItem('tamano_lote');
    localStorage.removeItem('opLiberacion');

    // Inicializar todas las tablas de Batch Record
    initializeBatchTables();
});

function initializeBatchTables() {
    // Tabla principal de Batch (Programados)
    if ($('#tablaBatch').length) {
        tablaBatch = $('#tablaBatch').DataTable({
            pageLength: 50,
            responsive: true,
            scrollCollapse: true,
            language: { url: '../../../admin/sistema/admin_componentes/es-ar.json' },
            oSearch: { bSmart: false },
            ajax: {
                url: '/html/php/batch_fetch_minimal.php',
                type: 'POST',
                dataSrc: 'data',
            },
            order: [[1, 'desc']],
            columns: [
                {
                    defaultContent: "<input type='radio' id='express' name='optradio' class='link-select'>",
                },
                {
                    title: 'Batch',
                    data: 1,
                },
                {
                    title: 'Referencia',
                    data: 2,
                    className: 'uniqueClassName',
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
                    title: 'Estado',
                    data: 5,
                    className: 'uniqueClassName',
                    render: (data, type, row) => {
                        'use strict';
                        return data == 1
                            ? 'Sin Formula y/o Instructivo'
                            : data == 2
                            ? 'Inactivo'
                            : data == 3
                            ? 'Pesaje'
                            : data == 3.5
                            ? 'Preparación'
                            : data == 4
                            ? 'Preparación'
                            : data == 4.5
                            ? 'Aprobación'
                            : data == 5
                            ? 'Aprobación'
                            : data == 5.5
                            ? 'Envasado/Acondicionamiento'
                            : data == 6
                            ? 'Envasado/Acondicionamiento'
                            : data == 6.5
                            ? 'Microbiologia/Fisicoquimico'
                            : data == 7
                            ? 'Microbiologia/Fisicoquimico'
                            : data == 7.5
                            ? 'Microbiologia/Fisicoquimico'
                            : data == 8
                            ? 'Microbiologia/Fisicoquimico'
                            : data == 8.5
                            ? 'Microbiologia/Fisicoquimico'
                            : data == 10
                            ? 'Liberación Lote'
                            : data == 11
                            ? 'Despachos'
                            : 'Cerrado';
                    },
                },
            ],
        });
    }

    // Tabla de Batch Cerrados
    if ($('#tablaBatchCerrados').length) {
        $('#tablaBatchCerrados').DataTable({
            pageLength: 50,
            responsive: true,
            scrollCollapse: true,
            language: { url: '../../../admin/sistema/admin_componentes/es-ar.json' },
            oSearch: { bSmart: false },
            bAutoWidth: false,
            ajax: {
                url: '/html/php/batch_fetch_minimal.php',
                type: 'POST',
                data: function(d) {
                    d.estado_min = 8; // Solo cerrados
                },
                dataSrc: 'data',
            },
            order: [[0, 'desc']],
            columns: [{
                    title: 'Batch',
                    data: 1,
                    className: 'uniqueClassName',
                },
                {
                    title: 'Referencia',
                    data: 2,
                    className: 'uniqueClassName',
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
                    title: 'Estado',
                    data: 5,
                    className: 'uniqueClassName',
                },
            ],
        });
    }

    // Tabla de Pedidos
    if ($('#tablaPedidos').length) {
        tablaPedidos = $('#tablaPedidos').DataTable({
            destroy: true,
            pageLength: 100,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            ajax: {
                url: `/html/php/pedidos_fetch.php`,
                type: 'POST',
                dataSrc: 'data',
            },
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
            },
            order: [
                [1, 'asc'],
                [2, 'asc'],
            ],
            columns: [
                {
                    title: 'No.',
                    data: 'num',
                    className: 'text-center',
                    visible: false,
                },
                {
                    title: 'Propietario',
                    data: 'propietario',
                    visible: false,
                },
                {
                    title: 'Pedido',
                    data: 'pedido',
                    className: 'text-center',
                },
                //{
                //    title: 'F_Pedido',
                //    data: 'fecha_pedido',
                //    className: 'text-center',
                //},
                {
                    title: 'Granel',
                    data: 'granel',
                    className: 'text-center',
                },
                {
                    title: 'Referencia',
                    data: 'id_producto',
                    className: 'text-center',
                },
                {
                    data: null,
                    className: 'uniqueClassName',
                    render: function (data) {
                        return `
                            <i class="badge badge-danger badge-pill notify-icon-badge ml-3">${data.cant_observations}</i><br>
                            <a href='#' <i class="fa fa-file-text fa-1x link-comentario" id=${data.id_batch} aria-hidden="true" data-toggle="tooltip" title="adicionar observaciones" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>
                        `;
                    },
                },
                {
                    title: 'Producto',
                    data: 'nombre_referencia',
                },
                {
                    title: 'Cant_Original',
                    data: 'cant_original',
                    className: 'text-center',
                    visible: false,
                    render: $.fn.dataTable.render.number('.', ',', 0, ' '),
                },
                {
                    title: 'Saldo Ofima',
                    data: 'saldo_ofima',
                    className: 'text-center',
                    render: $.fn.dataTable.render.number('.', ',', 0, ' '),
                },
                {
                    title: 'Acum Prog',
                    data: 'cantidad_acumulada',
                    className: 'text-center',
                    render: $.fn.dataTable.render.number('.', ',', 0, ' '),
                },
                {
                    title: 'Cant_Programar',
                    data: null,
                    render: function (data) {
                        return `
                            <input type="text" class="cantProgram form-control-updated text-center" id="cant-${data.pedido}-${data.id_producto}" />`;
                    },
                },
                {
                    title: 'Recep_Insumos día(1)',
                    data: null,
                    render: function (data) {
                        !data.fecha_insumo
                            ? (fecha_insumo = '')
                            : (fecha_insumo = data.fecha_insumo);

                        return `
                            <input type="date" class="dateInsumos form-control-updated text-center" id="date-${data.pedido}-${data.id_producto}" value="${fecha_insumo}" max="${data.fecha_actual}"/>`;
                    },
                },
                // {
                //     title: 'Escenario',
                //     data: 'simulacion',
                //     className: 'text-center',
                // },
                {
                    title: 'Fecha Entrega día (15)',
                    data: null,
                    render: function (data) {
                        return ` <p class ="text-center" id = "entrega-${data.pedido}-${data.id_producto}">${data.entrega}</p>`;
                    },
                },
            ],
            rowGroup: {
                dataSrc: function (row) {
                    return `<th class="text-center" colspan="13" style="font-weight: bold;"> ${row.propietario} </th>`;
                },
                startRender: function (rows, group) {
                    return $('<tr/>').append(group);
                },
                className: 'odd',
            },
            rowCallback: function (row, data, index) {
                if (data['estado'] == 1) $(row).css('color', 'green');
                if (data['estado'] == 2) $(row).css('color', 'red');
            },
        });
    }

    // Tabla de Batch Planeados
    if ($('#tablaBatchPlaneados').length) {
        tablaBatchPlaneados = $('#tablaBatchPlaneados').DataTable({
            pageLength: 50,
            responsive: true,
            scrollCollapse: true,
            language: {
                url: '../../../admin/sistema/admin_componentes/es-ar.json',
            },
            oSearch: { bSmart: false },
            ajax: { 
                url: '/html/php/batch_fetch_minimal.php', 
                type: 'POST',
                data: function(d) {
                    d.estado_min = 2; // Solo planeados
                },
                dataSrc: 'data' 
            },
            order: [[1, 'asc']],
            columns: [
                {
                    title: '',
                    data: 0,
                    className: 'text-center',
                    render: function (data) {
                        return `<input type='checkbox' id="planChk-${data}" class='link-select'>`;
                    },
                },
                {
                    title: 'Batch',
                    data: 1,
                    className: 'text-center',
                },
                {
                    title: 'Referencia',
                    data: 2,
                    className: 'text-center',
                },
                {
                    title: 'No Lote',
                    data: 3,
                    className: 'text-center',
                },
                {
                    title: 'Tamaño Lote (Kg)',
                    data: 4,
                    className: 'text-center',
                    render: $.fn.dataTable.render.number('.', ',', 2, ''),
                },
                {
                    title: 'Estado',
                    data: 5,
                    className: 'text-center',
                },
            ],
        });
    }

    // Tabla de Pre-Planeación
    if ($('#tablaPrePlaneacion').length) {
        tableBatchPrePlaneacion = $('#tablaPrePlaneacion').DataTable({
            destroy: true,
            pageLength: 50,
            ajax: {
                url: `/html/php/batch_fetch_minimal.php`,
                type: 'POST',
                data: function(d) {
                    d.estado_min = 0; // Solo pre-planeados
                },
                dataSrc: 'data',
            },
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
            },
            order: [1, 'asc'],
            columns: [
                {
                    title: 'Batch',
                    data: 1,
                    className: 'text-center',
                },
                {
                    title: 'Referencia',
                    data: 2,
                    className: 'text-center',
                },
                {
                    title: 'No Lote',
                    data: 3,
                    className: 'text-center',
                },
                {
                    title: 'Tamaño Lote (Kg)',
                    data: 4,
                    className: 'text-center',
                    render: $.fn.dataTable.render.number('.', ',', 2, ''),
                },
                {
                    title: 'Estado',
                    data: 5,
                    className: 'text-center',
                },
            ],
        });
    }
}
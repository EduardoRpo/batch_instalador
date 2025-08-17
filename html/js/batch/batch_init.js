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
            ajax: {
                url: `/html/php/pedidos_fetch.php`,
                type: 'POST',
                dataSrc: 'data',
            },
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
            },
            order: [
                [0, 'asc'],
                [1, 'asc'],
            ],
            columns: [
                {
                    title: 'Batch',
                    data: 0,
                    className: 'text-center',
                },
                {
                    title: 'Referencia',
                    data: 1,
                    className: 'text-center',
                },
                {
                    title: 'Nombre Referencia',
                    data: 2,
                    className: 'text-center',
                },
                {
                    title: 'No Lote',
                    data: 3,
                    className: 'text-center',
                },
                {
                    title: 'Tamaño Lote',
                    data: 4,
                    className: 'text-center',
                },
                {
                    title: 'Fecha Creación',
                    data: 5,
                    className: 'text-center',
                },
                {
                    title: 'Fecha Programación',
                    data: 6,
                    className: 'text-center',
                },
                {
                    title: 'Estado',
                    data: 7,
                    className: 'text-center',
                },
            ],
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
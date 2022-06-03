$(document).ready(function() {
    /* function crearTablaBatch(
              columna_busqueda = "",
              minDateFilter = "",
              maxDateFilter = ""
          ) {
           */
    tablaBatch = $('#tablaBatch').DataTable({
        pageLength: 50,
        responsive: true,
        scrollCollapse: true,
        language: { url: '../../../admin/sistema/admin_componentes/es-ar.json' },
        oSearch: { bSmart: false },

        ajax: {
            //method: "POST",
            url: '/api/batch',
            dataSrc: '',
            /* data: {
                      operacion: "1",
                      proceso: "1",
                      busqueda: columna_busqueda,
                      inicio: minDateFilter,
                      final: maxDateFilter,
                  }, */
        },

        columns: [{
                defaultContent: "<input type='radio' id='express' name='optradio' class='link-select'>",
            },
            {
                title: 'Batch',
                data: 'id_batch',
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
                title: 'Fecha Creación',
                data: 'fecha_creacion',
                className: 'uniqueClassName',
            },
            {
                title: 'Fecha Programación',
                data: 'fecha_programacion',
                className: 'uniqueClassName',
            },
            {
                title: 'Estado',
                data: 'estado',
                className: 'uniqueClassName',
                render: (data, type, row) => {
                    'use strict';
                    return data == 1 ?
                        'Sin Formula y/o Instructivo' :
                        data == 2 ?
                        'Inactivo' :
                        data == 3 ?
                        'Pesaje' :
                        data == 3.5 ?
                        'Preparación' :
                        data == 4 ?
                        'Preparación' :
                        data == 4.5 ?
                        'Aprobación' :
                        data == 5 ?
                        'Aprobación' :
                        data == 5.5 ?
                        'Envasado/Acondicionamiento' :
                        data == 6 ?
                        'Envasado/Acondicionamiento' :
                        data == 6.5 ?
                        'Microbiologia/Fisicoquimico' :
                        data == 7 ?
                        'Microbiologia/Fisicoquimico' :
                        data == 7.5 ?
                        'Microbiologia/Fisicoquimico' :
                        data == 8 ?
                        'Microbiologia/Fisicoquimico' :
                        data == 8.5 ?
                        'Microbiologia/Fisicoquimico' :
                        data == 10 ?
                        'Liberacion Lote' :
                        'Cerrado';
                },
            },
            {
                data: 'id_batch',
                className: 'uniqueClassName',
                render: function(data) {
                    return `<i class="fa fa-superscript link-editarMulti" id=${data} aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i>`;
                },
            },
            {
                title: 'Acciones',
                data: 'id_batch',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                        <a href='#' <i class='fa fa-pencil-square-o fa-2x link-editar' id=${data} data-toggle='tooltip' title='Editar Batch Record' style='color:rgb(255, 193, 7);'></i></a>
                        <a href='#' <i class='fa fa-trash link-borrar fa-2x' id=${data} data-toggle='tooltip' title='Eliminar Batch Record' style='color:rgb(234, 67, 54)'></i></a>`;
                },
            },
        ],
    });
    //}

    tablaPreBatch = $('#tablaPreBatch').DataTable({
        destroy: true,
        pageLength: 50,
        ajax: {
            url: `/api/preBatch`,
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
        },
        columns: [{
                title: 'Propietario',
                data: 'propietario',
            },
            {
                title: 'Pedido',
                data: 'pedido',
                className: 'text-center',
            },
            {
                title: 'Fecha_Dcto',
                data: 'fecha_pedido',
                className: 'text-center',
            },
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
                title: 'Producto',
                data: 'nombre_referencia',
            },
            {
                title: 'Cant_Original',
                data: 'cant_original',
                className: 'text-center',
                render: $.fn.dataTable.render.number('.', ',', 0, ' '),
            },
            {
                title: 'Cantidad',
                data: 'cantidad',
                className: 'text-center',
                render: $.fn.dataTable.render.number('.', ',', 0, ' '),
            },
            {
                title: 'Cant_Programar',
                data: null,
                render: function(data) {
                    return `
                    <input type="text" class="cantProgram form-control-updated text-center" id="cant-${data.pedido}-${data.id_producto}" />`;
                },
            },
            {
                title: 'Recep_Insumos',
                data: null,
                render: function(data) {
                    return `
                    <input type="date" class="dateInsumos form-control-updated text-center" id="date-${data.pedido}-${data.id_producto}" />`;
                },
            },
            {
                title: 'Fecha Pesaje',
                data: 'fecha_pesaje',
                className: 'text-center',
            },
            {
                title: 'Fecha Preparacion',
                data: 'fecha_preparacion',
                className: 'text-center',
            },
            {
                title: 'Recepcion Insumos',
                data: 'recepcion_insumos',
                className: 'text-center',
            },
            {
                title: 'Fecha Envasado',
                data: 'envasado',
                className: 'text-center',
            },
            {
                title: 'Fecha Entrega',
                data: 'entrega',
                className: 'text-center',
            },
            {
                title: 'Acciones',
                data: null,
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <div class="form-check"><input class="form-check-input checkboxPedidos" type="checkbox" id="${data.pedido}-${data.id_producto}"></div>`;
                },
            },
        ],
    });

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
                title: 'Fecha Creación',
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

    tablaBatchInactivos = $('#tablaBatchInactivos').DataTable({
        pageLength: 50,
        responsive: true,
        scrollCollapse: true,
        language: { url: '../../../admin/sistema/admin_componentes/es-ar.json' },
        oSearch: { bSmart: false },

        ajax: {
            url: '/api/batchInactivos',
            dataSrc: '',
        },

        columns: [{
                title: 'Batch',
                data: 'id_batch',
                className: 'text-center',
            },
            {
                title: 'Orden',
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
                title: 'Numero Lote',
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
                title: 'Fecha Creación',
                data: 'fecha_creacion',
                className: 'uniqueClassName',
            },
            {
                title: 'Fecha Programación',
                data: 'fecha_programacion',
                className: 'uniqueClassName',
            },
            {
                title: 'Estado',
                data: 'estado',
                className: 'uniqueClassName',
                render: (data, type, row) => {
                    'use strict';
                    return data == 1 ?
                        'Sin Formula y/o Instructivo' :
                        data == 2 ?
                        'Inactivo' :
                        data == 3 ?
                        'Pesaje' :
                        data == 3.5 ?
                        'Preparación' :
                        data == 4 ?
                        'Preparación' :
                        data == 4.5 ?
                        'Aprobación' :
                        data == 5 ?
                        'Aprobación' :
                        data == 5.5 ?
                        'Envasado/Acondicionamiento' :
                        data == 6 ?
                        'Envasado/Acondicionamiento' :
                        data == 6.5 ?
                        'Microbiologia/Fisicoquimico' :
                        data == 7 ?
                        'Microbiologia/Fisicoquimico' :
                        data == 7.5 ?
                        'Microbiologia/Fisicoquimico' :
                        data == 8 ?
                        'Microbiologia/Fisicoquimico' :
                        data == 8.5 ?
                        'Microbiologia/Fisicoquimico' :
                        data == 10 ?
                        'Liberacion Lote' :
                        'Multimodulo';
                },
            },
            {
                title: '',
                data: 'id_batch',
                className: 'uniqueClassName',
                render: function(data) {
                    return `<i class="fa fa-superscript link-editarMulti" id=${data} aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i>`;
                },
            },
            {
                title: 'Acciones',
                data: 'id_batch',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href='#' <i class='fa fa-pencil-square-o fa-2x link-editar' id=${data} data-toggle='tooltip' title='Editar Batch Record' style='color:rgb(255, 193, 7);'></i></a>
                    <a href='#' <i class='fa fa-trash link-borrar fa-2x' id=${data} data-toggle='tooltip' title='Eliminar Batch Record' style='color:rgb(234, 67, 54)'></i></a>`;
                },
            },
        ],
    });

    $(document).on('click', '.toggle-vis', function(e) {
        e.preventDefault();
        column = tablaPreBatch.column(this.id);
        column.visible(!column.visible());
    });

    /* Cargar la data de la fila de acuerdo con la datatable*/

    $("#tablaBatch tbody").on("click", "tr", function() {
        data = tablaBatch.row(this).data();
    });

    $('#tablaPreBatch tbody').on('click', 'tr', function() {
        fila = tablaPreBatch.row(this).data();
    });

    $("#tablaBatchInactivos tbody").on("click", "tr", function() {
        fila = tablaBatchInactivos.row(this).data();
    });


});
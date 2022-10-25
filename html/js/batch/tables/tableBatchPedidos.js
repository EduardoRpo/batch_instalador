$(document).ready(function() {
    tablaPedidos = $('#tablaPedidos').DataTable({
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
                visible: false,
            },
            {
                title: 'Pedido',
                data: 'pedido',
                className: 'text-center',
                visible: false,
            },
            {
                title: 'F_Pedido',
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
                data: null,
                className: 'uniqueClassName',
                render: function(data) {
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
                data: 'cantidad',
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
                render: function(data) {
                    return `
              <input type="text" class="cantProgram form-control-updated text-center" id="cant-${data.pedido}-${data.id_producto}" />`;
                },
            },
            {
                title: 'Recep_Insumos (1)',
                data: null,
                render: function(data) {
                    return `
              <input type="date" class="dateInsumos form-control-updated text-center" id="date-${data.pedido}-${data.id_producto}" value="${data.fecha_insumo}" max="${data.fecha_actual}"/>`;
                },
            },

            {
                title: 'Tipo simulación',
                data: 'simulacion',
                className: 'text-center',
            },
            /* /*  {
               title: 'Fecha Pesaje (8)',
               data: null,
               render: function (data) {
                 return ` <p class ="text-center" id = "pesaje-${data.pedido}-${data.id_producto}">${data.fecha_pesaje}</p>`;
               },
             },
             {
               title: 'Fecha Preparacion (9)',
               data: null,
               render: function (data) {
                 return ` <p class ="text-center" id = "preparacion-${data.pedido}-${data.id_producto}">${data.fecha_preparacion}</p>`;
               },
             },
             {
               title: 'Fecha Envasado (12)',
               data: null,
               render: function (data) {
                 return ` <p class ="text-center" id = "envasado-${data.pedido}-${data.id_producto}">${data.envasado}</p>`;
               },
             }, */
            {
                title: 'Fecha Entrega (15)',
                data: null,
                render: function(data) {
                    return ` <p class ="text-center" id = "entrega-${data.pedido}-${data.id_producto}">${data.entrega}</p>`;
                },
            },
        ],
        rowCallback: function(row, data, index) {
            if (data['estado'] == 1) $(row).css('color', 'green');
            if (data['estado'] == 2) $(row).css('color', 'red');
        },
    });

    $(document).on('click', '.toggle-vis', function(e) {
        e.preventDefault();
        column = tablaPedidos.column(this.id);
        column.visible(!column.visible());
    });
});
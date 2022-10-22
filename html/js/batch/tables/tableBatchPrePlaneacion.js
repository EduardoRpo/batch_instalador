$(document).ready(function() {
    tableBatchPrePlaneacion = $('#tablaPrePlaneacion').DataTable({
        destroy: true,
        pageLength: 50,
        ajax: {
            url: '/api/prePlaneados',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
        },
        columns: [{
                title: '',
                data: null,
                className: 'text-center',
                render: function(data) {
                    data.planeado == 1 ? (str = 'checked') : (str = '');

                    return `<input type='checkbox' id=${data.id} class='link-select' ${str}>`;
                },
            },
            {
                title: 'N° Semana',
                data: 'semana',
                className: 'text-center',
            },
            {
                width: '350px',
                title: 'Propietario',
                data: 'propietario',
                visible: false,
            },
            {
                title: 'Pedido',
                data: 'pedido',
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
                width: '350px',
                title: 'Producto',
                data: 'nombre_referencia',
                className: 'uniqueClassName',
            },
            {
                title: 'Unidad Lote',
                data: 'unidad_lote',
                className: 'text-center',
            },

            {
                title: 'Simulación',
                data: 'sim',
                className: 'text-center',
                visible: false,
            },
            {
                title: 'Estado',
                data: 'estado',
                className: 'text-center',
            },
            {
                data: 'id',
                className: 'uniqueClassName',
                render: function(data) {
                    return `<a href='#' <i class='fa fa-pencil-square-o fa-2x link-editar-pre' id=${data} data-toggle='tooltip' title='Editar Pre Planeado' style='color:rgb(255, 193, 7)'></i></a>`;
                },
            },
            {
                data: 'id',
                className: 'uniqueClassName',
                render: function(data) {
                    return `<a href='#' <i class='fa fa-trash link-borrar-pre fa-2x' id=${data} data-toggle='tooltip' title='Eliminar Pre Planeado' style='color:rgb(234, 67, 54)'></i></a>`;
                },
            },
        ],
        rowGroup: {
            dataSrc: 'propietario',
            startRender: function(rows, group) {
                return $('<tr/>').append(
                    '<th class="text-center" colspan="11" style="font-weight: bold;">' +
                    group +
                    '</th>'
                );
            },
            className: 'odd',
        },
    });

    /* Cargar tipo de simulación */
    $('#tipoSimulacion').change(function(e) {
        e.preventDefault();
        tableBatchPrePlaneacion.column(9).search(this.value).draw();
    });
});
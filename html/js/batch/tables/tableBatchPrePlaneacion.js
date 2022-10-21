$(document).ready(function () {
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
    columns: [
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
        title: 'F_Programacion',
        data: 'fecha_programacion',
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
      // {
      //   data: null,
      //   className: 'uniqueClassName',
      //   render: function (data) {
      //     return `
      //     <i class="badge badge-danger badge-pill notify-icon-badge ml-3">${data.cant_observations}</i><br>
      //     <a href='#' <i class="fa fa-file-text fa-1x link-comentario" id=${data.id_batch} aria-hidden="true" data-toggle="tooltip" title="adicionar observaciones" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>
      //     `;
      //   },
      // },
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
      },
    ],
    rowGroup: {
      dataSrc: 'propietario',
      startRender: function (rows, group) {
        return $('<tr/>').append(
          '<th class="text-center" colspan="7" style="font-weight: bold;">' +
            group +
            '</th>'
        );
      },
      className: 'odd',
    },
  });

  $(document).on('click', '.toggle-vis-pre', function (e) {
    e.preventDefault();
    column = tableBatchPrePlaneacion.column(this.id);
    column.visible(!column.visible());
  });

  /* Cargar tipo de simulación */
  $('#tipoSimulacion').change(function (e) {
    e.preventDefault();
    tableBatchPrePlaneacion.column(7).search(this.value).draw();
  });
});

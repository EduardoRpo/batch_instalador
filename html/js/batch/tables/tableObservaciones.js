$(document).ready(function () {
  tablaObservaciones = $('#tablaObservaciones').DataTable({
    destroy: true,
    pageLength: 50,
    ajax: {
      url: '/api/observacionesInactivos',
      dataSrc: '',
    },
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [
      {
        title: 'No.',
        data: null,
        className: 'text-center',
        render: function (data, type, full, meta) {
          return meta.row + 1;
        },
      },
      {
        title: 'Batch',
        data: 'id_batch',
        className: 'uniqueClassName',
      },
      {
        title: 'Pedido',
        data: 'pedido',
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
        className: 'uniqueClassName',
      },
      {
        title: 'Observacion',
        data: 'observacion',
        className: 'uniqueClassName',
      },
      {
        title: 'Fecha Registro',
        data: 'fecha_registro',
        className: 'uniqueClassName',
      },
    ],
  });
});

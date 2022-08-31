$(document).ready(function () {
  /* Cargue de Parametros de Control en DataTable */

  cargarTablaFormulas = (url) => {
    tabla = $('#tblFormulas').DataTable({
      destroy: true,
      scrollY: '50vh',
      scrollCollapse: true,
      paging: false,
      language: { url: 'admin_componentes/es-ar.json' },

      ajax: {
        url: url,
        dataSrc: '',
      },

      columns: [
        { title: 'Referencia', data: 'referencia' },
        { title: 'Materia prima', data: 'nombre' },
        { title: 'Alias', data: 'alias' },
        {
          title: '%',
          data: 'porcentaje',
          className: 'centrado',
          render: $.fn.dataTable.render.number(',', '.', 3, '', '%'),
        },
        {
          title: 'Acciones',
          defaultContent:
            "<a href='#' <i class='large material-icons link-editar tr' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar tr' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
        },
      ],
      columnDefs: [{ width: '10%', targets: 0 }],

      footerCallback: function (row, data, start, end, display) {
        total = this.api()
          .column(3)
          .data()
          .reduce(function (a, b) {
            return parseFloat(a) + parseFloat(b);
          }, 0);
        total = total.toFixed(2);
        $('#totalPorcentajeFormulas').val(`Total ${total}%`);
      },
    });
  };
});

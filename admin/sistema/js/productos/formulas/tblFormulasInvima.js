$(document).ready(function () {
  /* Cargue de Parametros de Control en DataTable */

  cargar_formulas_f = (url) => {
    tabla = $('#tbl_formulas_f').DataTable({
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
        { data: 'referencia' },
        { data: 'nombre' },
        { data: 'alias' },
        {
          data: 'porcentaje',
          className: 'centrado',
          render: $.fn.dataTable.render.number(',', '.', 3, '', '%'),
        },
        {
          defaultContent:
            "<a href='#' <i class='large material-icons link-editar tf' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a><a href='#' <i class='large material-icons link-borrar tf' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
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
        $('#totalPorcentajeFormulasInvima').val(`Total ${total}%`);
      },
    });
  };
});

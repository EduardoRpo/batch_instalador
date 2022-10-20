$(document).ready(function () {
  tblCapacidadEnvasado = $('#tblCapacidadEnvasado').DataTable({
    scrollY: '50vh',
    scrollCollapse: true,
    paging: false,
    language: { url: 'admin_componentes/es-ar.json' },

    ajax: {
      url: '/api/capacidadEnvasado',
      dataSrc: '',
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
        title: 'Semana',
        data: 'semana',
        className: 'text-center',
      },
      {
        title: 'Linea',
        data: 'nombre',
      },
      {
        title: 'Turno 1',
        data: 'turno_1',
        className: 'text-center',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
      },
      {
        title: 'Turno 2',
        data: 'turno_2',
        className: 'text-center',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
      },
      {
        title: 'Turno 3',
        data: 'turno_3',
        className: 'text-center',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
      },
      {
        title: 'Capacidad Total',
        data: 'total_capacidad',
        className: 'text-center',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
      },
      {
        title: 'Acciones',
        data: 'id_capacidad_envasado',
        className: 'text-center',
        render: function (data) {
          return `<a href='#' <i id=${data} class='updateEnv material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a> `;
        },
      },
    ],
  });
});

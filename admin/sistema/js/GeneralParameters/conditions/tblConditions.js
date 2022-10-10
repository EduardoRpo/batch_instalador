$(document).ready(function () {
  $('#listarCondiciones').DataTable({
    scrollY: '50vh',
    scrollCollapse: true,
    paging: false,
    language: { url: 'admin_componentes/es-ar.json' },

    ajax: {
      url: '/api/conditions',
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
        title: 'Modulo',
        data: 'modulo',
      },
      {
        title: 'Tiempo Mínimo',
        data: 't_min',
        className: 'text-center',
      },
      {
        title: 'Tiempo Maximo',
        data: 't_max',
        className: 'text-center',
      },
      {
        title: 'Acciones',
        data: 'id',
        className: 'text-center',
        render: function (data) {
          return `<a href='#' <i id=${data} class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>
                            <a href='#' <i id=${data} class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>`;
        },
      },
    ],
  });
});

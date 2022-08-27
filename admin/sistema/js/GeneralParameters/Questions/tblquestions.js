/* Mostrar Menu seleccionado */
$('.contenedor-menu .menu a').removeAttr('style');
$('#link_preguntas').css('background', 'coral');
$('.contenedor-menu .menu ul.menu_generales').show();

/* Cargue de Preguntas en DataTable */

tabla = $('#tblPreguntas').DataTable({
  scrollY: '50vh',
  scrollCollapse: true,
  paging: false,
  language: { url: 'admin_componentes/es-ar.json' },

  ajax: {
    url: '/api/questions',
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
      title: 'Pregunta',
      data: 'pregunta',
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
/* Enumera los registros en la tabla */

/* tabla
    .on("order.dt search.dt", function () {
      tabla
        .column(0, { search: "applied", order: "applied" })
        .nodes()
        .each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
    })
    .draw(); */

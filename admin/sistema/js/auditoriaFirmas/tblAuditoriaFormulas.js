$(document).ready(function () {
  tblAuditoriaFormulas = $('#tblAuditoriaFormulas').DataTable({
    pageLength: 20,
    scrollCollapse: true,
    language: { url: 'admin_componentes/es-ar.json' },

    ajax: {
      url: '/api/auditoriaFirmas',
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
        title: 'Accion',
        data: 'action',
        className: 'text-center',
      },
      {
        title: 'Fecha',
        data: 'action_time',
      },
      {
        title: 'Usuario',
        data: null,
        className: 'text-center',
        render: function (data) { 
          return `${data.nombre} ${data.apellido}`
         }
      },
      {
        title: 'Email',
        data: 'email',
        className: 'text-center', 
      },
      {
        title: 'Formula',
        data: 'formula_id',
        className: 'text-center',
      },
      {
        title: 'Datos Anteriores',
        data: 'old_formula_data',
        className: 'text-center',
      },
      {
        title: 'Datos Nuevos',
        data: 'new_formula_data',
        className: 'text-center',
      },
    ],
  });
});

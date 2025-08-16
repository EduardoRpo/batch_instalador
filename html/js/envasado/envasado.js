$(document).ready(function () {
  urlObs = '/api/observaciones';
  btnDeleteMulti = false;

  $('.adicionarMulti').hide();
  $('.footSaveMulti').hide();
  $('.addComment').hide();

  $('#saveObs').attr('style', 'display:none');

  $('#tablaEnvasado').dataTable({
    pageLength: 50,
    order: [[1, 'desc']],
    ajax: {
      url: '/html/php/envasado_fetch.php',
      type: 'POST',
      dataSrc: 'data',
    },
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [
      {
        title: 'Batch',
        data: 0,
        className: 'uniqueClassName',
      },
      {
        width: '20%',
        title: 'Fecha Programación',
        data: 1,
        className: 'uniqueClassName',
        render: function (data) {
          date = new Date(data);
          year = date.getFullYear();
          month = `${date.getMonth() + 1}`.padStart(2, 0);
          day = `${date.getDate()}`.padStart(2, 0);
          hour = date.toLocaleTimeString(undefined, {
            hour: '2-digit',
            minute: '2-digit',
          });

          stringDate = `${[year, month, day].join('-')} ${hour}`;

          return stringDate;
        },
      },
      {
        title: 'Referencia',
        data: 2,
        className: 'uniqueClassName',
      },
      {
        width: '400px',
        title: 'Nombre Referencia',
        data: 3,
        className: 'uniqueClassName',
      },
      {
        title: 'Ref',
        data: 0,
        className: 'uniqueClassName',
        render: function (data) {
          return `
                      <a href="# "<i class="fa fa-superscript link-editarMulti" id="${data}" aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>`;
        },
      },
      {
        title: 'Unidades',
        data: 5,
        className: 'uniqueClassName',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
      },
      {
        title: 'No Lote',
        data: 4,
        className: 'uniqueClassName',
      },
      {
        title: 'Firmas G',
        data: 6,
        className: 'uniqueClassName',
      },
      {
        title: 'Firmas T',
        data: 7,
        className: 'uniqueClassName',
      },
      {
        title: 'Obs',
        data: null,
        className: 'uniqueClassName',
        render: function (data, type, row) {
          return `
                    <i class="badge badge-danger badge-pill notify-icon-badge ml-3">0</i><br>
                    <a href='#' <i class="fa fa-file-text fa-1x link-comentario" id="${row[0]}-6" aria-hidden="true" data-toggle="tooltip" title="adicionar observaciones" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>
                  `;
        },
      },
      {
        title: 'Ingresar',
        className: 'uniqueClassName',
        data: '',
        render: (data, type, row) => {
          'use strict';
          return `<a href="envasadoinfo/${row[0]}/${row[2]}"><i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">touch_app</i></a>`;
        },
      },
    ],
  });
});

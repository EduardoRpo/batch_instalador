$(document).ready(function () {
  /* tabla calculo de capacidad envasado 
  $('#tblCalcCapacidadEnvasado').dataTable({
    pageLength: 3,
    ajax: {},
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    // columns: [
    //   {
    //     title: 'Semana',
    //     data: 'semana',
    //     className: 'uniqueClassName',
    //   },
    //   {
    //     title: 'No de Orden',
    //     data: 'numero_orden',
    //     className: 'uniqueClassName',
    //   },
    //   {
    //     title: 'Nombre Producto',
    //     data: 'referencia',
    //     className: 'uniqueClassName',
    //   },
    //   {
    //     title: 'Descripción',
    //     data: 'nombre_referencia',
    //     className: 'uniqueClassName',
    //   },
    //   {
    //     title: 'No Lote',
    //     data: 'numero_lote',
    //     className: 'uniqueClassName',
    //   },
    //   {
    //     title: 'Programacion',
    //     data: null,
    //     className: 'uniqueClassName',
    //     render: function (data) {
    //       !data.programacion_envasado
    //         ? (fechaProgramar = '')
    //         : (fecha = data.programacion_envasado);
    //       return `
    //     <input type="date" class="fechaProgramar form-control-updated text-center" id="${data.id_batch}" value="${data.programacion_envasado}" />`;
    //     },
    //   },
    // ],
  }); */

  loadtblCalcCapacidadEnvasado = () => {
    for (i = 1; i <= 52; i++) {
      $('.tblCalcCapacidadEnvasadoBody').append(`
      <tr>
        <td>${i}</td>
        <td>0 %</td>
        <td>0 %</td>
        <td>0 %</td>
        <td>0</td>
        <td>0 %</td>
        <td>0 %</td>
        <td>0 %</td>
        <td>0</td>
        <td>0 %</td>
        <td>0 %</td>
        <td>0 %</td>
        <td>0</td>
      </tr>
      `);
    }

    $('#tblCalcCapacidadEnvasado').dataTable({
      pageLength: 3,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
      },
    });
  };

  loadtblCalcCapacidadEnvasado();

  /* tabla envasado */
  $('#tablaEnvasado').dataTable({
    pageLength: 50,
    order: [[1, 'desc']],
    ajax: {
      url: '/api/programacionEnvasado',
      dataSrc: '',
    },
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [
      {
        title: 'Batch',
        data: 'id_batch',
        className: 'uniqueClassName',
      },
      {
        title: 'No de Orden',
        data: 'numero_orden',
        className: 'uniqueClassName',
      },
      {
        title: 'Nombre Producto',
        data: 'referencia',
        className: 'uniqueClassName',
      },
      {
        title: 'Descripción',
        data: 'nombre_referencia',
        className: 'uniqueClassName',
      },
      {
        title: 'No Lote',
        data: 'numero_lote',
        className: 'uniqueClassName',
      },
      {
        title: 'Programacion',
        data: null,
        className: 'uniqueClassName',
        render: function (data) {
          !data.programacion_envasado
            ? (fechaProgramar = '')
            : (fecha = data.programacion_envasado);
          return `
        <input type="date" class="fechaProgramar form-control-updated text-center" id="${data.id_batch}" value="${data.programacion_envasado}" />`;
        },
      },
      // {
      //   title: 'Firmas T',
      //   data: 'total_firmas',
      //   className: 'uniqueClassName',
      // },
      // {
      //   title: 'Ingresar',
      //   className: 'uniqueClassName',
      //   data: '',
      //   render: (data, type, row) => {
      //     'use strict';
      //     return `<a href="envasadoinfo/${row.id_batch}/${row.referencia}"><i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">touch_app</i></a>`;
      //   },
      // },
    ],
  });
});

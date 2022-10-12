$(document).ready(function () {
  /* tabla calculo de capacidad envasado */

  getData = async () => {
    try {
      result = await $.ajax({
        url: '/api/averageCapacidadEnvasado',
      });
      return result;
    } catch (error) {
      console.error(error);
    }
  };

  fetchindata = async () => {
    resp = await getData();
    loadtblCalcCapacidadEnvasado(resp);
  };
  fetchindata();

<<<<<<< HEAD
  loadtblCalcCapacidadEnvasado = (data) => {
    for (i = 1; i <= 52; i++) {
      $('.tblCalcCapacidadEnvasadoBody').append(`
      <tr>
        <td>${data[i].semana}</td>
        <td>${data[i].plan_liquido_1} %</td>
        <td>${data[i].plan_liquido_2} %</td>
        <td>${data[i].plan_liquido_3} %</td>
        <td>${data[i].total_liquido}</td>
        <td>${data[i].plan_solido_1} %</td>
        <td>${data[i].plan_solido_2} %</td>
        <td>${data[i].plan_solido_3} %</td>
        <td>${data[i].total_solido}</td>
        <td>${data[i].plan_semi_solido_1} %</td>
        <td>${data[i].plan_semi_solido_2} %</td>
        <td>${data[i].plan_semi_solido_3} %</td>
        <td>${data[i].total_semi_solido}</td>
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
=======
    loadtblCalcCapacidadEnvasado = () => {
        for (i = 1; i <= 52; i++) {
            $('.tblCalcCapacidadEnvasadoBody').append(`
                <tr>
                    <td>${i}</td>
                    <td>10 %</td>
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
            scrollY: '130px',
            scrollCollapse: true,
            paging: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
            },
        });
    };

    loadtblCalcCapacidadEnvasado();
>>>>>>> 94382d7eb4f8aa4828431051b8acd66093998447

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
        title: 'Unidades',
        data: 'unidad_lote',
        className: 'uniqueClassName',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
      },
      {
        title: 'Tamaño Lote(Kg)',
        data: 'tamano_lote',
        className: 'uniqueClassName',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
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

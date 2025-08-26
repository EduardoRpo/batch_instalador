$(document).ready(function () {
  btnDeleteMulti = true;
  /* Capacidad programados */
  api = '/api/batch';

  getDataProgramados = async () => {
    resp = await searchData(api);
    loadTblCapacidadProgramados(resp);
  };

  getDataProgramados();

  loadTblCapacidadProgramados = (data) => {
    semana = sessionStorage.getItem('semana');

    let capacidadProgramada = calcTamanioLoteBySemanaProgramados(
      data,
      parseInt(semana)
    );

    let rowProgramados = document.getElementById(
      'tblCalcCapacidadProgramadaBody'
    );

    for (i = 0; i < capacidadProgramada.length; i++) {
      rowProgramados.insertAdjacentHTML(
        'beforeend',
        `
        <tr>
          <td style="display: none">${i + 1}</td>
          <td class="text-center">${capacidadProgramada[i].semana}</td>
          <td class="text-center">${capacidadProgramada[
            i
          ].tamanioLoteLQ.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })}</td> 
          <td class="text-center">${capacidadProgramada[
            i
          ].tamanioLoteSL.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })}</td>
          <td class="text-center">${capacidadProgramada[
            i
          ].tamanioLoteSM.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })}</td>
          <td class="text-center">
            ${(
              capacidadProgramada[i].tamanioLoteLQ +
              capacidadProgramada[i].tamanioLoteSL +
              capacidadProgramada[i].tamanioLoteSM
            ).toLocaleString(undefined, {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}
            </td>
        </tr>
        `
      );
    }

    $('#tblCalcCapacidadProgramada').dataTable({
      scrollY: '130px',
      scrollCollapse: true,
      paging: false,
      searching: false,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
      },
    });
    setTimeout(alignTHeader, 5000);
  };

  alignTHeader = () => {
    // Validar que el elemento existe antes de usarlo
    const element = document.querySelector('#tblCalcCapacidadProgramados');
    if (!element) {
      console.warn('⚠️ alignTHeader: Elemento #tblCalcCapacidadProgramados no encontrado');
      return;
    }

    const firstElementChild = element.firstElementChild;
    if (!firstElementChild) {
      console.warn('⚠️ alignTHeader: firstElementChild no encontrado');
      return;
    }

    firstElementChild.insertAdjacentHTML(
      'afterend',
      '<tr class="odd"><th class="text-center" colspan="13" style="font-weight: bold;"> Total </th></tr>'
    );
  };

  calcTamanioLoteBySemanaProgramados = (data, semana) => {
    // Validar que data existe y es un array
    if (!data || !Array.isArray(data)) {
      console.warn('⚠️ calcTamanioLoteBySemanaProgramados: data no es válido:', data);
      return 0;
    }

    let capacidad = 0;
    for (i = 0; i < data.length; i++) {
      if (data[i].semana == semana) {
        capacidad = capacidad + data[i].tamano_lote;
      }
    }
    return capacidad;
  };

  tablaBatchProgramados = $('#tablaBatchProgramados').DataTable({
    pageLength: 50,
    responsive: true,
    scrollCollapse: true,
    language: {
      url: '../../../admin/sistema/admin_componentes/es-ar.json',
    },
    oSearch: { bSmart: false },

    ajax: {
      url: '/html/php/batch_fetch.php',
      type: 'POST',
      dataSrc: function(json) {
        console.log('=== DEBUG DATATABLES ===');
        console.log('JSON recibido:', json);
        console.log('Data count:', json.data ? json.data.length : 'No data');
        if (json.data && json.data.length > 0) {
          console.log('First row:', json.data[0]);
          console.log('First row columns:', json.data[0].length);
        }
        return json.data || [];
      }
    },
    order: [[1, 'desc']],
    columns: [
      {
        defaultContent:
          "<input type='radio' id='express' name='optradio' class='link-select'>",
      },
      {
        title: 'Batch',
        data: 1,
        render: function(data, type, row) {
          console.log('Columna Batch - data:', data, 'row:', row);
          return data;
        }
      },
      /* {
                    title: 'No Orden',
                    data: 'numero_orden',
                    className: 'uniqueClassName',
                  }, */
      {
        title: 'Referencia',
        data: 2,
        className: 'uniqueClassName',
        render: function(data, type, row) {
          console.log('Columna Referencia - data:', data, 'row:', row);
          return data;
        }
      },
      {
        title: 'Producto',
        data: 3,
        render: function(data, type, row) {
          console.log('Columna Producto - data:', data, 'row:', row);
          return data;
        }
      },
      {
        title: 'No Lote',
        data: 4,
        render: function(data, type, row) {
          console.log('Columna No Lote - data:', data, 'row:', row);
          return data;
        }
      },
      {
        title: 'Tamaño Lote',
        data: 5,
        className: 'uniqueClassName',
        render: $.fn.dataTable.render.number('.', ',', 2, ''),
      },
      /* {
                      title: 'Propietario',
                      data: 'nombre',
                  }, */
      /* {
                      title: 'Fecha Planeación',
                      data: 'fecha_creacion',
                      className: 'uniqueClassName',
                  }, */
      {
        title: 'Sem Plan',
        data: 6,
        className: 'uniqueClassName',
        render: function (data) {
          return `S${data}`;
        },
      },
      {
        title: 'Sem Prog',
        data: 7,
        className: 'uniqueClassName',
        render: function (data) {
          return `S${data}`;
        },
      },
      {
        title: 'Fecha Programación',
        data: 8,
        className: 'uniqueClassName',
      },
      {
        title: 'Estado',
        data: 9,
        className: 'uniqueClassName',
        render: (data, type, row) => {
          'use strict';
          return data == 1
            ? 'Sin Formula y/o Instructivo'
            : data == 2
            ? 'Inactivo'
            : data == 3
            ? 'Pesaje'
            : data == 3.5
            ? 'Preparación'
            : data == 4
            ? 'Preparación'
            : data == 4.5
            ? 'Aprobación'
            : data == 5
            ? 'Aprobación'
            : data == 5.5
            ? 'Envasado/Acondicionamiento'
            : data == 6
            ? 'Envasado/Acondicionamiento'
            : data == 6.5
            ? 'Microbiologia/Fisicoquimico'
            : data == 7
            ? 'Microbiologia/Fisicoquimico'
            : data == 7.5
            ? 'Microbiologia/Fisicoquimico'
            : data == 8
            ? 'Microbiologia/Fisicoquimico'
            : data == 8.5
            ? 'Microbiologia/Fisicoquimico'
            : data == 10
            ? 'Liberacion Lote'
            : 'Cerrado';
        },
      },
      {
        title: 'Obs',
        data: null,
        className: 'uniqueClassName',
        render: function (data) {
          return `
                    <i class="badge badge-danger badge-pill notify-icon-badge ml-3">${data.cant_observations}</i><br>
                    <a href='#' <i class="fa fa-file-text fa-1x link-comentario" id=${data.id_batch} aria-hidden="true" data-toggle="tooltip" title="adicionar observaciones" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>
                  `;
        },
      },
      {
        title: 'Multi',
        data: 'id_batch',
        className: 'uniqueClassName',
        render: function (data) {
          return `<i class="fa fa-superscript link-editarMulti" id=${data} aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i>`;
        },
      },

      {
        title: 'Modificar',
        data: 'id_batch',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-pencil-square-o fa-2x link-editar' id=${data} data-toggle='tooltip' title='Editar Batch Record' style='color:rgb(255, 193, 7)'></i></a>`;
        },
      },
      {
        title: 'Eliminar',
        data: 'id_batch',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-trash link-borrar fa-2x' id=${data} data-toggle='tooltip' title='Eliminar Batch Record' style='color:rgb(234, 67, 54)'></i></a>`;
        },
      },
    ],
  });
});

// Función global para cargar total de ventas
loadTotalVentas = () => {
  let totalVentaPlan = 0;
  let totalVentaPre = 0;

  let dataBPlaneacion = tablaBatchPlaneados.rows().data().toArray();
  let dataBPreplaneacion = tableBatchPrePlaneacion.rows().data().toArray();

  for (i = 0; i < dataBPlaneacion.length; i++) {
    totalVentaPlan =
      totalVentaPlan +
      dataBPlaneacion[i]['unidad_lote'] * dataBPlaneacion[i]['valor_pedido'];
  }

  for (i = 0; i < dataBPreplaneacion.length; i++) {
    totalVentaPre =
      totalVentaPre +
      dataBPreplaneacion[i]['unidad_lote'] *
        dataBPreplaneacion[i]['valor_pedido'];
  }

  $('#totalVentaPre').val(`$ ${totalVentaPre.toLocaleString('es-CO')}`);
  $('#totalVentaPlan').val(`$ ${totalVentaPlan.toLocaleString('es-CO')}`);
};

$(document).ready(function () {
  /* Capacidad Planeada */
  api = '/html/php/batch_planeados_fetch.php';

  getDataPlaneacion = async () => {
    console.log('🚀 getDataPlaneacion - Iniciando obtención de datos');
    try {
      resp = await searchData(api);
      console.log('✅ getDataPlaneacion - Datos obtenidos:', resp);
      console.log('🔍 getDataPlaneacion - Tipo de resultado:', typeof resp);
      console.log('🔍 getDataPlaneacion - Es array:', Array.isArray(resp));
      if (resp && resp.data) {
        console.log('🔍 getDataPlaneacion - Número de registros:', resp.data.length);
        console.log('🔍 getDataPlaneacion - Primer registro:', resp.data[0]);
      }
      loadTblCapacidadPlaneada(resp);
    } catch (error) {
      console.error('❌ getDataPlaneacion - Error:', error);
    }
  };

  getDataPlaneacion();

  loadTblCapacidadPlaneada = (data) => {
    console.log('🚀 loadTblCapacidadPlaneada - Iniciando con datos:', data);
    semana = sessionStorage.getItem('semana');
    console.log('🔍 loadTblCapacidadPlaneada - Semana de sessionStorage:', semana);
    let capacidadPlaneada = calcTamanioLoteBySemana(data, parseInt(semana));
    console.log('🔍 loadTblCapacidadPlaneada - Capacidad calculada:', capacidadPlaneada);

    let rowPlaneados = document.getElementById('tblCalcCapacidadPlaneadaBody');

    for (i = 0; i < capacidadPlaneada.length; i++) {
      rowPlaneados.insertAdjacentHTML(
        'beforeend',
        `
          <tr>
            <td style="display: none">${i + 1}</td>
            <td class="text-center">${capacidadPlaneada[i].semana}</td>
            <td class="text-center">${capacidadPlaneada[
              i
            ].tamanioLoteLQ.toLocaleString(undefined, {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}</td> 
            <td class="text-center">${capacidadPlaneada[
              i
            ].tamanioLoteSL.toLocaleString(undefined, {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}</td>
            <td class="text-center">${capacidadPlaneada[
              i
            ].tamanioLoteSM.toLocaleString(undefined, {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}</td>
            <td class="text-center">
            ${(
              capacidadPlaneada[i].tamanioLoteLQ +
              capacidadPlaneada[i].tamanioLoteSL +
              capacidadPlaneada[i].tamanioLoteSM
            ).toLocaleString(undefined, {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}
            </td>
          </tr>
        `
      );
    }

    $('#tblCalcCapacidadPlaneada').dataTable({
      scrollY: '130px',
      scrollCollapse: true,
      paging: false,
      searching: false,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
      },
    });
  };

  tablaBatchPlaneados = $('#tablaBatchPlaneados').DataTable({
    pageLength: 50,
    responsive: true,
    scrollCollapse: true,
    language: {
      url: '../../../admin/sistema/admin_componentes/es-ar.json',
    },
    oSearch: { bSmart: false },

    ajax: { 
      url: '/html/php/batch_planeados_fetch.php', 
      type: 'POST',
      dataSrc: 'data',
      dataFilter: function(data) {
        console.log('🔍 tableBatchPlaneados - Datos recibidos del servidor:', data);
        return data;
      }
    },
    order: [[3, 'asc']],
    columns: [
      {
        title: '',
        data: 'id',
        className: 'text-center',
        render: function (data) {
          return `<input type='checkbox' id="planChk-${data}" class='link-select'>`;
        },
      },
      {
        title: 'N°',
        data: null,
        className: 'text-center',
        render: function (data, type, row, meta) {
          return meta.row + 1;
        },
      },
      {
        title: 'N° Semana',
        data: 'semana',
        className: 'text-center',
        render: function (data) {
          return `S${data}`;
        },
      },
      /*
      {
        width: '350px',
        title: 'Propietario',
        data: 'propietario',
        visible: false,
      },
      */
      {
        title: 'Pedido',
        data: 'pedido',
        className: 'text-center',
      },
      {
        title: 'Granel',
        data: 'granel',
        className: 'text-center',
      },
      {
        title: 'Referencia',
        data: 'referencia',
        className: 'text-center',
      },
      {
        width: '350px',
        title: 'Producto',
        data: 'nombre_referencia',
        className: 'uniqueClassName',
      },
      {
        title: 'Tamaño Lote (Kg)',
        data: 'tamano_lote',
        className: 'text-center',
        render: $.fn.dataTable.render.number('.', ',', 2, ''),
      },
      {
        title: 'Cantidad (Und)',
        data: 'unidad_lote',
        className: 'text-center',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
      },
      {
        title: 'Simulación',
        data: 'sim',
        className: 'text-center',
        visible: false,
      },
      {
        title: 'F. Insumo',
        data: 'fecha_insumo',
        className: 'text-center',
      },
      {
        title: 'F.Sugerida Pesaje',
        data: 'fecha_pesaje',
        className: 'text-center',
      },
      {
        title: 'F.Sugerida Envasado',
        data: 'fecha_envasado',
        className: 'text-center',
      },
      {
        title: 'Estado',
        data: 'estado',
        className: 'text-center',
        render: function (data) {
          if (data == 0) {
            return 'Falta Formula e Instructivo';
          } else if (data == 1) {
            return 'Inactivo';
          } else {
            return data; // Para cualquier otro valor, mostrar el valor original
          }
        },
      },
      {
        data: 'id',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-trash link-borrar-pre fa-2x' id="delete-${data}" data-toggle='tooltip' title='Eliminar Pre Planeado' style='color:rgb(234, 67, 54)'></i></a>`;
        },
      },
    ],
    rowGroup: {
      dataSrc: function (row) {
        return `<th class="text-center" colspan="13" style="font-weight: bold;"> ${row.propietario || 'Sin Cliente'} </th>`;
      },
      startRender: function (rows, group) {
        return $('<tr/>').append(group);
      },
      className: 'odd',
    },
  });

  setTimeout(loadTotalVentas, 11000);
  
  console.log('🔍 tableBatchPlaneados - Tabla inicializada completamente');
});

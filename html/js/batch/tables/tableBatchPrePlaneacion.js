$(document).ready(function () {
  /* Capacidad prePlaneada */
  api = '/api/prePlaneados';

  getDataPrePlaneacion = async () => {
    resp = await searchData(api);
    loadTblCapacidadPrePlaneada(resp);
  };

  getDataPrePlaneacion();

  loadTblCapacidadPrePlaneada = (data) => {
    semana = sessionStorage.getItem('semana');
    capacidadPrePlaneada = calcTamanioLoteBySemana(data, parseInt(semana));

    for (i = 0; i < 12; i++) {
      $('.tblCalcCapacidadPrePlaneadoBody').append(`
          <tr class="rows" id="row-${i}">
            <td>${capacidadPrePlaneada[i].semana}</td>
            <td>${capacidadPrePlaneada[i].tamanioLoteLQ.toFixed(2)}</td> 
            <td>${capacidadPrePlaneada[i].tamanioLoteSL.toFixed(2)}</td>
            <td>${capacidadPrePlaneada[i].tamanioLoteSM.toFixed(2)}</td>
          </tr>
        `);
    }

    tblCalcCapacidadPrePlaneado = $('#tblCalcCapacidadPrePlaneado').DataTable({
      scrollY: '130px',
      scrollCollapse: true,
      paging: false,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
      },
    });
  };

  calcTamanioLoteBySemana = (data, semana) => {
    let capacidad = [];

    for (i = 0; i < 12; i++) {
      capacidad.push({
        semana: semana + i,
        tamanioLoteLQ: 0,
        tamanioLoteSM: 0,
        tamanioLoteSL: 0,
      });
    }

    for (i = 0; i < data.length; i++) {
      for (j = 0; j < capacidad.length; j++) {
        if (capacidad[j].semana == data[i].semana) {
          capacidad[j].linea = data[i].id_linea;

          if (capacidad[j].linea == 1)
            capacidad[j].tamanioLoteLQ += data[i].tamano_lote;
          else if (capacidad[j].linea == 2)
            capacidad[j].tamanioLoteSM += data[i].tamano_lote;
          else if (capacidad[j].linea == 3)
            capacidad[j].tamanioLoteSL += data[i].tamano_lote;
        }
      }
    }

    return capacidad;
  };

  tableBatchPrePlaneacion = $('#tablaPrePlaneacion').DataTable({
    destroy: true,
    pageLength: 50,
    ajax: {
      url: `/api/prePlaneados`,
      dataSrc: '',
    },
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [
      {
        title: 'N° Semana',
        data: 'semana',
        className: 'text-center',
        render: function (data) {
          return `S${data}`;
        },
      },
      {
        width: '350px',
        title: 'Propietario',
        data: 'propietario',
        visible: false,
      },
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
        data: 'id_producto',
        className: 'text-center',
      },
      {
        width: '500px',
        title: 'Producto',
        data: 'nombre_referencia',
        className: 'uniqueClassName',
      },
      {
        title: 'Tamaño Lote (Kg)',
        data: 'tamano_lote',
        className: 'text-center',
        render: $.fn.dataTable.render.number('.', ',', 1, ''),
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
        title: 'Estado',
        data: 'estado',
        className: 'text-center',
      },
      {
        title: 'Modificar',
        data: 'id',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-pencil-square-o fa-2x link-editar-pre' id="edit-${data}" data-toggle='tooltip' title='Editar Pre Planeado' style='color:rgb(255, 193, 7)'></i></a>`;
        },
      },
      {
        title: 'Eliminar',
        data: 'id',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-trash link-borrar-pre fa-2x' id="borrar-${data}" data-toggle='tooltip' title='Eliminar Pre Planeado' style='color:rgb(234, 67, 54)'></i></a>`;
        },
      },
    ],
    rowGroup: {
      dataSrc: 'propietario',
      startRender: function (rows, group) {
        return $('<tr/>').append(
          '<th class="text-center" colspan="11" style="font-weight: bold;">' +
            group +
            '</th>'
        );
      },
      className: 'odd',
    },
  });

  /* Cargar tipo de simulación */

  $('#tipoSimulacion').change(function (e) {
    e.preventDefault();

    let val = this.value;

    let totalVentaPre = 0;

    tableBatchPrePlaneacion.column(8).search(val).draw();

    dataBPreplaneacion = tableBatchPrePlaneacion.rows().data().toArray();

    for (i = 0; i < dataBPreplaneacion.length; i++) {
      if (dataBPreplaneacion[i]['sim'] == val) {
        totalVentaPre =
          totalVentaPre +
          dataBPreplaneacion[i]['unidad_lote'] *
            dataBPreplaneacion[i]['valor_pedido'];
      }
    }

    $('#totalVentaPre').val(`$ ${totalVentaPre.toLocaleString('es-CO')}`);

    semana = sessionStorage.getItem('semana');

    val == 1
      ? (semana = parseInt(semana) + 1)
      : (semana = parseInt(semana) + 2);

    month = calcDateByWeek(semana);

    $('.fechaTipoEscenario').html(`
      <div class="col">
        <label style="margin-top:37px">S${semana} (${month})</label>
      </div>
    `);
    $('.rows').css('display', '');

    dataCPreplaneacion = tblCalcCapacidadPrePlaneado.rows().data().toArray();
    for (i = 0; i < dataCPreplaneacion.length; i++) {
      if (dataCPreplaneacion[i][0] != semana) {
        $(`#row-${i}`).css('display', 'none');
      }
    }
  });

  /* Calcular primera y ultima fecha de la semana */
  calcDateByWeek = (semana) => {
    let date = new Date();

    let primerdia = new Date(date.getFullYear(), 0, 1);

    let correccion = 6 - primerdia.getDay();

    let primer = new Date(
      date.getFullYear(),
      0,
      (semana - 1) * 7 + 3 + correccion
    );

    let ultimo = new Date(
      date.getFullYear(),
      0,
      (semana - 1) * 7 + 9 + correccion
    );

    let mesPrimer = primer.toLocaleString(undefined, { month: 'long' });
    let mesUltimo = ultimo.toLocaleString(undefined, { month: 'long' });

    month = `${primer.getDate()} ${mesPrimer} - ${ultimo.getDate()} ${mesUltimo}`;

    return month;
  };
});

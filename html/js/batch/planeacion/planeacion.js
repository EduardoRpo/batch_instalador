$(document).ready(function () {
  let dataPlaneacion = [];
  dataTanquesPlaneacion = [];
  idTanque = 0;

  $(document).on('click', '.link-select', function () {
    let id = this.id;
    let idPlan = id.slice(8, id.length);

    if ($(`#${id}`).is(':checked')) {
      let dataPlan = tablaBatchPlaneados.row($(this).parents('tr')).data();

      let estado = dataPlan.estado;

      if (estado == 'Inactivo') {
        /* Calculo tamaño lote - ajuste */
        let totalTamanioLote =
          dataPlan.tamano_lote - dataPlan.tamano_lote * dataPlan.ajuste;

        planeacion = {
          id: idPlan,
          granel: dataPlan.granel,
          producto: dataPlan.nombre_referencia,
          referencia: dataPlan.id_producto,
          fecha_planeacion: dataPlan.fecha_programacion,
          fecha_insumo: dataPlan.fecha_insumo,
          numPedido: dataPlan.pedido,
          cantidad_acumulada: dataPlan.unidad_lote,
          tamanio_lote: totalTamanioLote,
        };

        dataPlaneacion.push(planeacion);
      } else {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('No es posible programar este pedido');
        $(`#${id}`).prop('checked', false);
        return false;
      }
    } else {
      for (i = 0; i < dataPlaneacion.length; i++) {
        if (dataPlaneacion[i].id == idPlan) {
          dataPlaneacion.splice(i, 1);
        }
      }
    }
  });

  $('#btnProgramar').click(function (e) {
    e.preventDefault();

    if (dataPlaneacion.length == 0) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Seleccione pedido para planear');
      return false;
    }

    $('#formCreateTanques').trigger('reset');
    $('#formCreateTanques').css('border-color', '');

    $.ajax({
      type: 'POST',
      url: '/api/programPlan',
      data: { data: dataPlaneacion },
      success: function (resp) {
        alertifyProgramar(resp);
      },
    });
  });

  alertifyProgramar = (data) => {
    count = data.length;

    totalCantAndLote = sumCantAndLote(data);

    alertify
      .confirm(
        'Samara Cosmetics',
        `<p>¿Desea programar los pedidos?</p><p><br></p>
                <table class="table table-striped dataTable text-center" aria-describedby="tablaPedidos_info">
                <thead>
                  <tr>
                    <th class="text-center">Granel</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Cantidad (Und)</th>
                    <th class="text-center">Tamaño (Kg)</th>
                    <th class="text-center" style="width: 131px">Tanques</th>
                    <th class="text-center">Cantidad (Tanques)</th>
                  </tr>
                </thead>
                <tbody>
                  <form id="formCreateTanques">
                    ${(row = addRowsPedidos(data))} 
                  </form>
                </tbody>
                <tfoot>
                  <tr >
                    <th></th>
                    <th></th>
                    <th class="text-center">${
                      totalCantAndLote.totalCantidades
                    }</th>
                    <th class="text-center">${totalCantAndLote.totalLotes.toFixed(
                      2
                    )}</th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
            </table><br>`,
        function () {
          let cant = document.getElementsByClassName('txtCantidad');
          let symbol = document.getElementsByClassName('symbolPedidos');

          save = true;

          for (i = 1; i < cant.length; i++) {
            if (cant[i].disabled == false) {
              cantidad = cant[i].value;

              if (!cantidad || cantidad == null) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('Ingrese fecha de programación');
                $(`#${cant[i].id}`).css('border-color', 'red');
                save = false;
                return false;
              }
            }
          }

          if (save == true)
            for (i = 0; i < symbol.length; i++) {
              if (symbol[i].id == 'correct') {
                break;
              }
              if (symbol[i].id == 'incorrect') {
                save = false;
              }
            }

          if (save == true) saveFechaProgramacion();
          else {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('No es posible programar los pedidos');
            return false;
          }
        },
        function () {
          dataPlaneacion = [];
          unique = [];
          dataTanquesPlaneacion = [];

          clearInputArray();
        }
      )
      .set('labels', { ok: 'Si', cancel: 'No' })
      .set({ closableByDimmer: false })
      .set('resizable', true)
      .resizeTo(1200, 548);

    cargarTanques();
  };

  sumCantAndLote = (data) => {
    totalCantidades = 0;
    totalLotes = 0;
    for (i = 0; i < data.length; i++) {
      totalCantidades += data[i].cantidad_acumulada;
      totalLotes += data[i].tamanio_lote;
    }

    totalCantAndLote = {
      totalCantidades: totalCantidades,
      totalLotes: totalLotes,
    };

    return totalCantAndLote;
  };

  addRowsPedidos = (data) => {
    row = [];
    for (i = 0; i < data.length; i++) {
      data[i].tamanio_lote > 2500 ? (dis = 'disabled') : (dis = '');

      row.push(`<tr ${(text = color(data[i].tamanio_lote))}>
                <td id="granel-${i}">${data[i].granel}</td>
                <td>${data[i].producto}</td>
                <td>${data[i].cantidad_acumulada}</td>
                <td id="tamanioLote-${i}">${data[i].tamanio_lote.toFixed(
        2
      )}</td>
                <td>
                  <select class="form-control-updated select-tanque" id="cmbTanque-${i}" ${dis}></select>
                </td>
                <td>
                  <input type="number" class="form-control-updated text-center txtCantidad" id="cantTanque-${i}" ${dis}>
                </td>
                ${(symbol = check(data[i].tamanio_lote))}
                </tr>`);
    }
    return row.join('');
  };

  saveFechaProgramacion = () => {
    let date = new Date();

    let year = date.getFullYear();

    let month = `${date.getMonth() + 1}`.padStart(2, 0);

    let day = `${date.getDate()}`.padStart(2, 0);

    let stringDate = `${[year, month, day].join('-')}`;

    alertify
      .prompt(
        'Programación',
        'Ingrese la fecha de programación',
        '',
        function (evt, value) {
          if (!value || value == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese fecha de programación');
            return false;
          }

          if (value < stringDate) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese una fecha apartir del dia de hoy');
            return false;
          }

          unique = Object.values(
            dataTanquesPlaneacion.reduce((a, c) => {
              a[c.granel] = c;
              return a;
            }, {})
          );

          unique.push({ date: value });

          savePlaneados(unique);
        },
        function () {
          dataPlaneacion = [];
          unique = [];
          dataTanquesPlaneacion = [];

          clearInputArray();
        }
      )
      .set('type', 'date')
      .set({ closableByDimmer: false });
  };

  savePlaneados = (data) => {
    $.ajax({
      type: 'POST',
      url: '/api/saveBatch',
      data: { data: data },
      success: function (data) {
        message(data);
        unique = [];
        dataPlaneacion = [];
        dataTanquesPlaneacion = [];
        deleteSession();
        setTimeout(loadTotalVentas, 7000);
        if ($.fn.dataTable.isDataTable('#tblCalcCapacidadPlaneada')) {
          $('#tblCalcCapacidadPlaneada').DataTable().destroy();
        }
        $('#tblCalcCapacidadPlaneadaBody').empty();
        if ($.fn.dataTable.isDataTable('#tblCalcCapacidadProgramada')) {
          $('#tblCalcCapacidadProgramada').DataTable().destroy();
        }
        $('#tblCalcCapacidadProgramadaBody').empty();
        api = '/api/batchPlaneados';
        getDataPlaneacion();
        api = '/api/batch';
        getDataProgramados();
      },
    });
  };
});

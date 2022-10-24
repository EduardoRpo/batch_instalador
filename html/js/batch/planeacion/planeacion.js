$(document).ready(function () {
  let dataPlaneacion = {};

  $('#btnProgramar').click(function (e) {
    e.preventDefault();

    data = tableBatchPrePlaneacion.rows().data();

    data.forEach((t) => {
      repeat = false;
      for (i = 0; i < dataPlaneacion.length; i++) {
        if (dataPlaneacion[i].granel == $t.granel) {
          dataPlaneacion[
            i
          ].numPedido = `${dataPlaneacion[i].pedido} - ${t.pedido}`;
          dataPlaneacion[i].cantidad_acumulada += t.unidad_lote;
          dataPlaneacion[
            i
          ].fecha_insumo = `${dataPlaneacion[$i].fecha_insumo} - ${t.fecha_insumo}`;
          $repeat = true;
          break;
        }
      }

      if (repeat == false)
        dataPlaneacion = {
          granel: t.granel,
        };
    });
  });
});

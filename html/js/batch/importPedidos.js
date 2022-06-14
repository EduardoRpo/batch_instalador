$('#btnImportarPedidos').click(function (e) {
  e.preventDefault();
  file = $('#filePedidos').val();

  if (!file) {
    alertify.set('notifier', 'position', 'top-right');
    alertify.error('Seleccione un archivo');
    return false;
  }

  importFile(selectedFile)
    .then((data) => {
      let OrderToImport = data.map((item) => {
        return {
          cliente: item.Cliente,
          nombre_cliente: item.Nombre_Cliente,
          documento: item.Documento,
          fecha_dcto: item.Fecha_Dcto,
          producto: item.Producto,
          nombre_producto: item.Nombre_Producto,
          cant_original: item.Cant_Original,
          cantidad: item.Cantidad,
        };
      });
      checkImport(OrderToImport);
    })
    .catch(() => {
      console.log('Ocurrio un error. Intente Nuevamente');
    });
});

/* Validar datos */
checkImport = (data) => {
  $.ajax({
    type: 'POST',
    url: '/api/validacionDatosPedidos',
    data: { data: data },
    success: function (resp) {
      if (resp.error == true) {
        alertify.error(resp.message);
        $('#filePedidos').val('');
        return false;
      }

      alertify
        .confirm(
          'Importar Pedidos',
          `Se han encontrado los siguientes registros:<br><br>
                      <div class="row">
                         <div class="col">Datos a insertar: ${resp.insert}</div>
                         <div class="col">Cantidad filas: ${resp.pedidos}</div>
                         <div class="w-100"></div>
                         <div class="col">Datos a actualizar: ${resp.update}</div>
                         <div class="col">Cantidad referencias: ${resp.referencias}</div>
                       </div><br><br>
                         Desea continuar?`,
          function () {
            savePedidos();
          },
          function () {
            $('#filePedidos').val('');
            deletePedidosSession();
          }
        )
        .set('labels', { ok: 'Si', cancel: 'No' });
    },
  });
};

//Opcion SI
savePedidos = () => {
  $.ajax({
    type: 'POST',
    url: '/api/addPedidos',
    success: function (resp) {
      if (resp.success) {
        actualizarTablaPedidos();
        $('.cardImportarPedidos').hide(800);
        $('#filePedidos').val('');
      }
      notificaciones(resp);
    },
  });
};

//Opcion NO
deletePedidosSession = () => {
  $.ajax({
    type: 'GET',
    url: '/api/deletePedidosSession',
  });
};

$('#btnPedidosNoEncontrados').click(function (e) {
  e.preventDefault();

  $.ajax({
    type: 'GET',
    url: '/api/sendNonExistentProducts',
    success: function (resp) {
      if (resp.error) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error(resp.message);
        return false;
      }

      alertify.alert(
        'Pedidos No Encontrados',
        `<p>No se han importado los siguientes pedidos:</p><br>
                  <table class="table table-striped table-bordered dataTable no-footer text-center">
                    <thead>
                      <tr>
                        <th class="text-center">Pedido</th>
                        <th class="text-center">Referencia</th>
                      </tr>
                    </thead>
                    <tbody>
                      ${(row = addRow(resp))}
                    </tbody>
                  </table>
        `
      );
    },
  });
});

addRow = (data) => {
  pedido = data.pedido;
  referencia = data.referencia;

  row = [];
  for (i = 0; i < pedido.length; i++) {
    row.push(`<tr>
              <td>${pedido[i]}</td>
              <td>${referencia[i]}</td>
              </tr>`);
  }
  return row.join('');
};

/* Actualizar tabla */

function actualizarTablaPedidos() {
  $('#tablaPreBatch').DataTable().clear();
  $('#tablaPreBatch').DataTable().ajax.reload();
}

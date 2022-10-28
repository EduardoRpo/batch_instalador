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
          cliente: item.Cliente.trim(),
          nombre_cliente: item.Nombre_Cliente.trim(),
          documento: item.Documento.trim(),
          fecha_dcto: item.Fecha_Dcto.trim(),
          producto: item.Producto.trim(),
          nombre_producto: item.Nombre_Producto_Mvto.trim(),
          // nombre_producto: item.Nombre_Producto.trim(),
          cant_original: item.Cant_Original.trim(),
          cantidad: item.Cantidad.trim(),
          valor_pedido: item.Vlr_Venta.trim(),
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
                         <div class="w-100"></div>
                         <div class="col">Sin producto: ${resp.nonProducts}</div>
                       </div><br><br>
                        <p>Desea continuar?</p>
                         `,
          function () {
            yesOption();
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
yesOption = async () => {
  response = await savePedidos();
  if (response.success) {
    actualizarTablaPedidos();
    $('#filePedidos').val('');

    $('.fechaImporte').html(
      `<p>Fecha y Hora de importación: ${response.fecha_hora_importe.fecha_importe}, ${response.fecha_hora_importe.hora_importe}</p>`
    );
  }
  notificaciones(response);

  //deletePedidosSession();
};

savePedidos = async () => {
  try {
    result = await $.ajax({
      url: '/api/addPedidos',
      type: 'POST',
    });
    return result;
  } catch (error) {
    console.error(error);
  }
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
  fetchindata();
});

fetchindata = async () => {
  response = await findNonExistentProducts();

  if (response.error) {
    alertify.set('notifier', 'position', 'top-right');
    alertify.error(response.message);
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
            ${(row = addRow(response))}
          </tbody>
        </table>
    `
  );
  $('.cardImportarPedidos').hide(800);
  $('#filePedidos').val('');
};

findNonExistentProducts = async () => {
  try {
    result = await $.ajax({
      url: '/api/sendNonExistentProducts',
    });
    return result;
  } catch (error) {
    console.error(error);
  }
};

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
  $('#tablaPedidos').DataTable().clear();
  $('#tablaPedidos').DataTable().ajax.reload();
}

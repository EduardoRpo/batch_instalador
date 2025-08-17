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
                // Normalizar las claves del Excel (convertir a minúsculas)
                let normalizedItem = {};
                Object.keys(item).forEach(key => {
                    let normalizedKey = key.toLowerCase().trim();
                    normalizedItem[normalizedKey] = item[key] ? item[key].toString().trim() : "";
                });

                // Verificar que no sea la fila de encabezados
                if (normalizedItem.cliente && normalizedItem.cliente.toLowerCase() !== 'cliente') {
                    return {
                        cliente: normalizedItem.cliente || "",
                        nombre_cliente: normalizedItem.nombre_cliente || "",
                        documento: normalizedItem.documento || "",
                        fecha_dcto: normalizedItem.fecha_dcto || "",
                        producto: normalizedItem.producto || "",
                        nombre_producto: normalizedItem.nombre_producto_mvto || "",
                        cant_original: normalizedItem.cant_original ? parseInt(normalizedItem.cant_original, 10) : 0,
                        cantidad: normalizedItem.cantidad ? parseInt(normalizedItem.cantidad, 10) : 0,
                        valor_pedido: normalizedItem.vlr_venta ? parseFloat(normalizedItem.vlr_venta) : 0.0,
                    };
                }
            });

            OrderToImport = OrderToImport.filter(function (item) {
                return item !== undefined;
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
                         <div class="col">Referencias no creadas: ${resp.nonProducts}</div>
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
        'Referencias aún no creadas',
        `<table class="table table-striped table-bordered dataTable no-footer text-center">
          <thead>
            <tr>
              <th class="text-center">No</th>
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
    row = [];
    for (i = 0; i < data.length; i++) {
        row.push(`<tr>
              <td>${i + 1}</td>
              <td>${data[i]['documento']}</td>
              <td>${data[i]['producto']}</td>
              </tr>`);
    }
    return row.join('');
};

/* Actualizar tabla */

function actualizarTablaPedidos() {
    $('#tablaPedidos').DataTable().clear();
    $('#tablaPedidos').DataTable().ajax.reload();
}
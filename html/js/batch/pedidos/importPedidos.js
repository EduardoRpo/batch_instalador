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
                let cleanItem = Object.fromEntries(
                    Object.entries(item).map(([key, value]) => [
                        key.trim(),
                        value ? value.toString().trim() : "",
                    ])
                );

                // Verificar que no sea la fila de encabezados y que tenga datos válidos
                if (cleanItem.Cliente && cleanItem.Cliente.trim() !== 'Cliente' && cleanItem.Cliente.trim() !== 'cliente') {
                    return {
                        cliente: cleanItem.Cliente ? cleanItem.Cliente.trim() : "",
                        nombre_cliente: cleanItem.Nombre_Cliente
                            ? cleanItem.Nombre_Cliente.trim()
                            : "",
                        documento: cleanItem.Documento ? cleanItem.Documento.trim() : "",
                        fecha_dcto: cleanItem.Fecha_Dcto ? cleanItem.Fecha_Dcto.trim() : "",
                        producto: cleanItem.Producto ? cleanItem.Producto.trim() : "",
                        nombre_producto: cleanItem.Nombre_Producto_Mvto
                            ? cleanItem.Nombre_Producto_Mvto.trim()
                            : "",
                        cant_original: cleanItem.Cant_Original
                            ? parseInt(cleanItem.Cant_Original.trim(), 10)
                            : 0,
                        cantidad: cleanItem.Cantidad ? parseInt(cleanItem.Cantidad.trim(), 10) : 0,
                        valor_pedido: cleanItem.Vlr_Venta
                            ? parseFloat(cleanItem.Vlr_Venta.trim())
                            : 0.0,
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
    console.log('=== DIAGNÓSTICO IMPORTACIÓN ===');
    console.log('Datos a enviar:', data);
    console.log('URL del endpoint:', '/html/php/import_pedidos_simple.php');
    
    $.ajax({
        type: 'POST',
        url: '/html/php/import_pedidos_simple.php',
        data: JSON.stringify({ data: data }),
        contentType: 'application/json',
        success: function (resp) {
            console.log('=== RESPUESTA EXITOSA ===');
            console.log('Respuesta completa:', resp);
            console.log('Tipo de respuesta:', typeof resp);
            console.log('resp.insert:', resp.insert);
            console.log('resp.update:', resp.update);
            console.log('resp.nonProducts:', resp.nonProducts);
            console.log('resp.pedidos:', resp.pedidos);
            console.log('resp.referencias:', resp.referencias);
            
            if (resp.error == true) {
                console.log('Error en respuesta:', resp.message);
                alertify.error(resp.message);
                $('#filePedidos').val('');
                return false;
            }
            
            // Verificar que todos los valores existan
            const insert = resp.insert || 0;
            const update = resp.update || 0;
            const nonProducts = resp.nonProducts || 0;
            const pedidos = resp.pedidos || 0;
            const referencias = resp.referencias || 0;
            
            console.log('Valores procesados:', { insert, update, nonProducts, pedidos, referencias });
            
            alertify
                .confirm(
                    'Importar Pedidos',
                    `Se han encontrado los siguientes registros:<br><br>
                      <div class="row">
                         <div class="col">Datos a insertar: ${insert}</div>
                         <div class="col">Cantidad filas: ${pedidos}</div>
                         <div class="w-100"></div>
                         <div class="col">Datos a actualizar: ${update}</div>
                         <div class="col">Cantidad referencias: ${referencias}</div>
                         <div class="w-100"></div>
                         <div class="col">Referencias no creadas: ${nonProducts}</div>
                       </div><br><br>
                        <p>Desea continuar?</p>
                         `,
                    function () {
                        console.log('Usuario confirmó la importación');
                        yesOption();
                    },
                    function () {
                        console.log('Usuario canceló la importación');
                        $('#filePedidos').val('');
                        deletePedidosSession();
                    }
                )
                .set('labels', { ok: 'Si', cancel: 'No' });
        },
        error: function(xhr, status, error) {
            console.log('=== ERROR EN AJAX ===');
            console.log('Status:', status);
            console.log('Error:', error);
            console.log('Response Text:', xhr.responseText);
            console.log('Status Code:', xhr.status);
            alertify.error('Error al procesar los datos: ' + error);
            $('#filePedidos').val('');
        }
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
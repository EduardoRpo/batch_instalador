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
                        value ? value.trim() : "",
                    ])
                );


                if (cleanItem.Cliente.trim() !== 'Cliente')
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
                            : 0, // Convertir a número
                        cantidad: cleanItem.Cantidad ? parseInt(cleanItem.Cantidad.trim(), 10) : 0, // Convertir a número
                        valor_pedido: cleanItem.Vlr_Venta
                            ? parseFloat(cleanItem.Vlr_Venta.trim())
                            : 0.0, // Convertir a número
                    };
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
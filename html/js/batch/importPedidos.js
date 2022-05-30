$('#btnImportarPedidos').click(function(e) {
    e.preventDefault();

    file = $('#filePedidos').val();

    if (!file) {
        alertify.set("notifier", "position", "top-right");
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
                    cantidad: item.Cantidad
                };
            });
            checkImport(OrderToImport);
        })
        .catch(() => {
            console.log('Ocurrio un error. Intente Nuevamente');
        });
});

/* Mensaje de advertencia */
checkImport = (data) => {
    $.ajax({
        type: 'POST',
        url: '/api/validacionDatosPedidos',
        data: { data: data },
        success: function(resp) {
            if (resp.error == true) {
                alertify.error(resp.message);
                $('#filePedidos').val('');
                return false;
            }

            alertify.confirm('Importar Pedidos', `Se han encontrado los siguientes registros:<br><br>Datos a insertar: ${resp.insert} <br>Datos a actualizar: ${resp.update}<br><br> Desea continuar?`,
                function() {
                    savePedidos(data);
                },
                function() {
                    alertify.error('Cancelado')
                    $('#filePedidos').val('')
                }).set('labels', { ok: 'Si', cancel: 'No' });
        },
    });
};

savePedidos = (data) => {
    $.ajax({
        type: 'POST',
        url: '/api/addPedidos',
        data: { data: data },
        success: function(resp) {
            if (resp.success)
                actualizarTabla()

            notificacion(resp)
        }
    })
}

/* Actualizar tabla */

function actualizarTabla() {
    $("#tablaPreBatch").DataTable().clear();
    $("#tablaPreBatch").DataTable().ajax.reload();
}
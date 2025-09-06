/**
 * MODIFICADO: Mejora en importación de pedidos para mostrar solo datos actualizados
 * FECHA: 2025-01-09
 * MOTIVO: Usuario requiere que los datos actualizados aparezcan en la vista después de confirmar
 * CAMBIOS:
 * - Modificar yesOption para usar API real en lugar de simulación
 * - Implementar función mostrarSoloDatosActualizados() para filtrar vista
 * - Agregar botón "Mostrar todos los pedidos" para alternar vista
 * - Mejorar actualizarTablaPedidos() para recrear tabla correctamente
 * - Mantener compatibilidad con funcionalidad existente
 */

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

            OrderToImport = OrderToImport.filter((item) => item !== undefined);

            if (OrderToImport.length > 0) {
                validateDataOrdersImport(OrderToImport);
            } else {
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('El archivo está vacío o no contiene datos válidos');
            }
        })
        .catch((error) => {
            console.error('Error en el procesamiento del archivo:', error);
            alertify.set('notifier', 'position', 'top-right');
            alertify.error(
                'Error al procesar el archivo. Verifique que sea un archivo Excel válido.'
            );
        }
        $('#filePedidos').val('');
        }
    });

validateDataOrdersImport = async (data) => {
    try {
        response = await $.ajax({
            url: '/api/validacionDatosPedidos',
            type: 'POST',
            data: JSON.stringify({ data: data }),
            contentType: 'application/json; charset=utf-8',
        });

        if (response.error) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error(response.message);
            return false;
        }

        // Configuración del modal de confirmación
        let confirMessage = `
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Datos a insertar:</strong> ${response.insert}</p>
                        <p><strong>Datos a actualizar:</strong> ${response.update}</p>
                        <p><strong>Referencias no creadas:</strong> ${response.nonProducts}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Cantidad filas:</strong> ${response.pedidos}</p>
                        <p><strong>Cantidad referencias:</strong> ${response.referencias}</p>
                    </div>
                </div>
                <br>
                <p>¿Desea continuar?</p>
            </div>
        `;

        // Mostrar modal de confirmación
        alertify.confirm('Importar Pedidos', confirMessage, yesOption, noOption);
        $('.cardImportarPedidos').hide(800);
        $('#filePedidos').val('');
    } catch (error) {
        console.error('Error en validación:', error);
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Error al validar los datos. Intente nuevamente.');
        $('#filePedidos').val('');
    }
};

//Opcion NO
noOption = () => {
    deletePedidosSession();
    $('.cardImportarPedidos').show(800);
    $('#filePedidos').val('');
};

//Opcion SI - MODIFICADA PARA MOSTRAR SOLO DATOS ACTUALIZADOS
yesOption = async () => {
    try {
        // Llamar a la API para procesar la importación
        const response = await savePedidos();
        
        if (response && response.success) {
            // Mostrar información de importación
            $('.fechaImporte').html(
                `<p>Fecha y Hora de importación: ${response.fecha_hora_importe.fecha_importe}, ${response.fecha_hora_importe.hora_importe}</p>`
            );
            
            // Si hay datos actualizados, mostrar solo esos en la tabla
            if (response.idsActualizados && response.idsActualizados.length > 0) {
                // Modificar la fuente de datos de la tabla para mostrar solo datos actualizados
                await mostrarSoloDatosActualizados();
                
                alertify.set('notifier', 'position', 'top-right');
                alertify.success(`¡Pedidos importados exitosamente! Se actualizaron ${response.idsActualizados.length} registros.`);
            } else {
                // Si no hay datos actualizados, mostrar todos como antes
                actualizarTablaPedidos();
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('¡Pedidos importados exitosamente!');
            }
            
            notificaciones(response);
        } else {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Error al procesar la importación. Intente nuevamente.');
        }
    } catch (error) {
        console.error('Error en yesOption:', error);
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Error al procesar la importación. Intente nuevamente.');
    }
    
    // Limpiar el campo de archivo
    $('#filePedidos').val('');
};

// NUEVA FUNCIÓN: Mostrar solo los datos actualizados en la tabla
mostrarSoloDatosActualizados = async () => {
    try {
        // Destruir la tabla actual si existe
        if ($.fn.DataTable.isDataTable('#tablaPedidos')) {
            $('#tablaPedidos').DataTable().destroy();
        }
        
        // Recrear la tabla con nueva fuente de datos para mostrar solo los actualizados
        $('#tablaPedidos').DataTable({
            destroy: true,
            pageLength: 100,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            ajax: {
                url: `/api/getPedidosActualizados`,  // NUEVO ENDPOINT
                type: 'GET',
                dataSrc: 'data',
            },
            language: {
                url: '../../../admin/sistema/admin_componentes/es-ar.json'
            },
            order: [[2, 'asc']],
            columns: [
                { title: 'No.', data: 'num', className: 'text-center', visible: false },
                { title: 'Propietario', data: 'propietario', visible: false },
                { title: 'Pedido', data: 'pedido', className: 'text-center' },
                { title: 'F_Pedido', data: 'fecha_pedido', className: 'text-center' },
                { title: 'Granel', data: 'granel', className: 'text-center' },
                { title: 'Referencia', data: 'id_producto', className: 'text-center' },
                { title: 'Producto', data: 'nombre_referencia' },
                { title: 'Cant_Original', data: 'cant_original', className: 'text-center', visible: false, render: $.fn.dataTable.render.number('.', ',', 0, ' ') },
                { title: 'Saldo Ofima', data: 'cantidad', className: 'text-center', render: $.fn.dataTable.render.number('.', ',', 0, ' ') },
                { title: 'Acum Prog', data: 'cantidad_acumulada', className: 'text-center', render: $.fn.dataTable.render.number('.', ',', 0, ' ') },
                { title: 'Recep_Insumos dia(1)', data: 'fecha_insumo', className: 'text-center' },
                { title: 'Fecha Entrega dia (15)', data: 'entrega', className: 'text-center' }
            ],
            initComplete: function() {
                // Mostrar mensaje indicando que se muestran solo los datos actualizados
                alertify.set('notifier', 'position', 'top-right');
                alertify.message('Mostrando solo los pedidos actualizados en esta importación');
                
                // Opcional: Agregar un botón para volver a mostrar todos los datos
                if (!$('#btnMostrarTodos').length) {
                    $('#tablaPedidos_wrapper').prepend(`
                        <div class="mb-3">
                            <button id="btnMostrarTodos" class="btn btn-info btn-sm">
                                <i class="fa fa-list"></i> Mostrar todos los pedidos
                            </button>
                        </div>
                    `);
                    
                    $('#btnMostrarTodos').click(function() {
                        actualizarTablaPedidos(); // Volver a mostrar todos los datos
                        $(this).parent().remove(); // Remover el botón
                    });
                }
            }
        });
        
    } catch (error) {
        console.error('Error al mostrar datos actualizados:', error);
        // Fallback: mostrar todos los datos
        actualizarTablaPedidos();
    }
};

savePedidos = async () => {
    try {
        result = await $.ajax({
            url: '/api/addPedidos',
            type: 'POST',
        });
        return result;
    } catch (error) {
        console.error('Error en savePedidos:', error);
        return null;
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

/* Actualizar tabla - VERSIÓN ORIGINAL PARA MOSTRAR TODOS LOS DATOS */
function actualizarTablaPedidos() {
    // Destruir tabla actual si existe
    if ($.fn.DataTable.isDataTable('#tablaPedidos')) {
        $('#tablaPedidos').DataTable().destroy();
    }
    
    // Remover botón de mostrar todos si existe
    $('#btnMostrarTodos').parent().remove();
    
    // Recrear tabla con configuración original (todos los datos)
    $('#tablaPedidos').DataTable({
        destroy: true,
        pageLength: 100,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        ajax: {
            url: `/html/php/pedidos_fetch.php`,  // ENDPOINT ORIGINAL
            type: 'POST',
            dataSrc: 'data',
        },
        language: {
            url: '../../../admin/sistema/admin_componentes/es-ar.json'
        },
        order: [[2, 'asc']],
        columns: [
            { title: 'No.', data: 'num', className: 'text-center', visible: false },
            { title: 'Propietario', data: 'propietario', visible: false },
            { title: 'Pedido', data: 'pedido', className: 'text-center' },
            { title: 'F_Pedido', data: 'fecha_pedido', className: 'text-center' },
            { title: 'Granel', data: 'granel', className: 'text-center' },
            { title: 'Referencia', data: 'id_producto', className: 'text-center' },
            { title: 'Producto', data: 'nombre_referencia' },
            { title: 'Cant_Original', data: 'cant_original', className: 'text-center', visible: false, render: $.fn.dataTable.render.number('.', ',', 0, ' ') },
            { title: 'Saldo Ofima', data: 'cantidad', className: 'text-center', render: $.fn.dataTable.render.number('.', ',', 0, ' ') },
            { title: 'Acum Prog', data: 'cantidad_acumulada', className: 'text-center', render: $.fn.dataTable.render.number('.', ',', 0, ' ') },
            { title: 'Recep_Insumos dia(1)', data: 'fecha_insumo', className: 'text-center' },
            { title: 'Fecha Entrega dia (15)', data: 'entrega', className: 'text-center' }
        ]
    });
}

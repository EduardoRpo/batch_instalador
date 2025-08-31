/* firmar 2da sección  */

function firmar2daSeccion(firma) {
    console.log('🔍 firmar2daSeccion - Iniciando función');
    console.log('🔍 firmar2daSeccion - Firma recibida:', firma);
    console.log('🔍 firmar2daSeccion - Módulo actual:', modulo);
    console.log('🔍 firmar2daSeccion - ID Batch:', idBatch);
    console.log('🔍 firmar2daSeccion - Tanques totales:', tanques);
    console.log('🔍 firmar2daSeccion - Tanques completados:', tanquesOk);

    if (modulo == 5)
        return

    let data = {
        modulo: modulo,
        idBatch: idBatch,
        tanques: tanques,
        tanquesOk: tanquesOk,
        realizo: firma.id,
        controlProducto: controlProducto,
    };

    console.log('🔍 firmar2daSeccion - Datos que se van a enviar:', data);
    console.log('🔍 firmar2daSeccion - URL del endpoint: /api/saveBatchTanques');
    console.log('📤 firmar2daSeccion - Enviando datos al backend...');

    $.ajax({
        type: 'POST',
        url: '/api/saveBatchTanques',
        data: data,
        beforeSend: function() {
            console.log('⏳ firmar2daSeccion - Iniciando petición AJAX');
        },
        success: function(response) {
            console.log('✅ firmar2daSeccion - Respuesta recibida:', response);
            console.log('🔍 firmar2daSeccion - Tipo de respuesta:', typeof response);
            console.log('🔍 firmar2daSeccion - Respuesta.success:', response.success);
            console.log('🔍 firmar2daSeccion - Respuesta.message:', response.message);

            if (response) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.success(response.message);
                $(`#chkcontrolTanques${tanquesOk}`).prop('disabled', true);

                if (modulo == 2) {
                    console.log('🔍 firmar2daSeccion - Procesando módulo 2 (pesaje)');
                    $(tablePesaje).find('tbody tr').removeClass('tr_hover');
                    $(tablePesaje).find('tbody tr').removeClass('not-active');
                    $(tablePesaje).find('tbody .valor').html(' ');

                    lotes.length = 0;
                }

                if (modulo == 3 || modulo == 4) {
                    console.log('🔍 firmar2daSeccion - Procesando módulo 3 o 4');
                    $(`.especificacion`).val('0');
                    $(`.especificacionInput`).val('');
                }

                if (modulo == 3) reiniciarInstructivo();
                if (tanques == tanquesOk) {
                    console.log('🔍 firmar2daSeccion - Todos los tanques completados, ejecutando firmarSeccionCierreProceso');
                    firmarSeccionCierreProceso(firma);
                }
            } else {
                console.log('❌ firmar2daSeccion - Respuesta vacía o nula');
                alertify.set('notifier', 'position', 'top-right');
                alertify.error(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('❌ firmar2daSeccion - Error en petición AJAX');
            console.log('🔍 firmar2daSeccion - Status:', status);
            console.log('🔍 firmar2daSeccion - Error:', error);
            console.log('🔍 firmar2daSeccion - XHR status:', xhr.status);
            console.log('🔍 firmar2daSeccion - XHR responseText:', xhr.responseText);
            
            try {
                let errorResponse = JSON.parse(xhr.responseText);
                console.log('�� firmar2daSeccion - Error response parsed:', errorResponse);
            } catch (e) {
                console.log('🔍 firmar2daSeccion - No se pudo parsear la respuesta de error');
            }
            
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Error al procesar la firma. Revisa la consola para más detalles.');
        }
    });
}

function firmarSeccionCierreProceso(firma) {
    let orden = localStorage.getItem('orden');
    let tamano_lote = localStorage.getItem('tamano_lote');
    modulo === 10 ?
        (obs_batch = $('#observacionesLoteRechazado').val()) :
        (obs_batch = '');

    cargarObsIncidencias(firma);
    deshabilitarbtn();
}

/* almacenar firma calidad 2da seccion */

function almacenarfirma(info) {
    idUser = info.id;
    $.ajax({
        type: 'POST',
        url: '../../html/php/incidencias.php',
        data: { operacion: 4, modulo: modulo, idBatch, verifico: idUser },

        success: function(response) {
            if (response == 0) {

                modulo == 4 ?
                    (modulos = 'pesaje y/o preparacion') :
                    (modulos = 'envasado y/o acondicionamiento');

                alertify.set('notifier', 'position', 'top-right');
                alertify.error(`No es posible cerrar este proceso para el Batch ${idBatch}. Los módulos de ${modulos} aún no se encuentran completamente firmados`);
                return false;
            }

            if (modulo == 2)
                $('.pesaje_verificado')
                .css({ background: 'lightgray', border: 'gray' })
                .prop('disabled', true);
            if (modulo == 3)
                $('.preparacion_verificado')
                .css({ background: 'lightgray', border: 'gray' })
                .prop('disabled', true);
            if (modulo == 4)
                $('.aprobacion_verificado')
                .css({ background: 'lightgray', border: 'gray' })
                .prop('disabled', true);
            if (modulo == 8)
                $('.aprobacion_verificado')
                .css({ background: 'lightgray', border: 'gray' })
                .prop('disabled', true);
            if (modulo == 9) {
                $('.fisicoquimica_verificado')
                    .css({ background: 'lightgray', border: 'gray' })
                    .prop('disabled', true);
                cargarObsIncidencias(info);
            }

            firmar(info);

            alertify.set('notifier', 'position', 'top-right');
            alertify.success('Firmado satisfactoriamente');
        },
    });
}
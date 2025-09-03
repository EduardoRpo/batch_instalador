/* firmar 2da sección  */

function firmar2daSeccion(firma) {
    console.log('🔍 firmar2daSeccion - Iniciando función');
    console.log('🔍 firmar2daSeccion - Firma recibida:', firma);
    console.log('🔍 firmar2daSeccion - Módulo actual:', modulo);
    console.log('🔍 firmar2daSeccion - ID Batch:', idBatch);
    
    // Verificar y inicializar variables globales
    if (typeof tanques === 'undefined' || tanques === null) {
        console.log('⚠️ firmar2daSeccion - Variable tanques no definida, inicializando...');
        tanques = 0;
        // Intentar obtener desde sessionStorage
        const tanquesFromStorage = sessionStorage.getItem('tanques');
        if (tanquesFromStorage) {
            tanques = parseInt(tanquesFromStorage);
            console.log('🔍 firmar2daSeccion - Tanques obtenidos de sessionStorage:', tanques);
        }
    }
    
    // Verificar variable lotes para módulo 2
    if (modulo == 2 && (typeof lotes === 'undefined' || lotes === null)) {
        console.log('⚠️ firmar2daSeccion - Variable lotes no definida, inicializando...');
        lotes = [];
    }
    
    console.log('🔍 firmar2daSeccion - Tanques totales:', tanques);

    if (modulo == 5)
        return

    let tanquesOk = 0;

    /* validar tanque seleccionados */
    for (let i = 1; i <= tanques; i++)
        if ($(`#chkcontrolTanques${i}`).is(':checked')) tanquesOk++;

    console.log('🔍 firmar2daSeccion - Tanques completados:', tanquesOk);

    let data;

    /* carga data de acuerdo con el modulo */

    if (modulo == 2) {
        data = { operacion: 1, tanques, tanquesOk, modulo, lotes, idBatch, linea: 1 };
        console.log('🔍 firmar2daSeccion - Configurando datos para módulo 2 (pesaje)');
    }

    if (modulo == 3) {
        equipos = [];
        equipos.push($('#sel_agitador').val());
        equipos.push($('#sel_marmita').val());
        
        // MODIFICADO: Agregar campo usuario para el archivo local
        // ANTES: data = { operacion: 1, equipos, tanques, tanquesOk, modulo, idBatch, controlProducto, linea: 1 };
        // AHORA: data incluye usuario para guardarTerceraFirma.php
        // Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
        data = { 
            operacion: 1, 
            equipos, 
            tanques, 
            tanquesOk, 
            modulo, 
            idBatch, 
            controlProducto, 
            linea: 1,
            usuario: firma.usuario || firma.id
        };
        console.log('🔍 firmar2daSeccion - Configurando datos para módulo 3 (preparación)');
    }

    if (modulo == 4) {
        let desinfectante = $('#sel_producto_desinfeccion').val();
        const obs_desinfectante = $('#in_observaciones').val() || ''; // Asegurar que sea string vacío si está vacío
        desinfectante === undefined ? (desinfectante = '') : desinfectante;
        const obs_batch = $('#observacionesAprobacion').val();
        data = { operacion: 1, tanques, tanquesOk, modulo, idBatch, desinfectante, obs_desinfectante, obs_batch, realizo: firma.id, controlProducto, linea: 1 };
        console.log('🔍 firmar2daSeccion - Configurando datos para módulo 4 (aprobación)');
    }

    if (modulo == 9) {
        const desinfectante = $('#sel_producto_desinfeccion').val();
        const obs_desinfectante = $('#in_observaciones').val() || ''; // Asegurar que sea string vacío si está vacío
        const obs_batch = $('#observacionesLoteRechazado').val();
        data = { operacion: 1, desinfectante, obs_desinfectante, obs_batch, modulo, idBatch, realizo: firma.id, controlProducto, linea: 1 };
        console.log('🔍 firmar2daSeccion - Configurando datos para módulo 9 (fisicoquímico)');
    }

    console.log('🔍 firmar2daSeccion - Datos que se van a enviar:', data);
    
    // MODIFICADO: Cambiar de API que falla a archivo local para la tercera firma
    // ANTES: url: '/api/saveBatchTanques' (error 500 por tabla GESTION_GRANELES_TRACKING)
    // AHORA: url: '../../html/php/guardarTerceraFirma.php' (archivo local funcional)
    // Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
    let urlEndpoint = '';
    if (modulo == 3) {
        urlEndpoint = '../../html/php/guardarTerceraFirma.php';
        console.log('🔍 firmar2daSeccion - Usando archivo local para módulo 3 (preparación)');
    } else {
        urlEndpoint = '/api/saveBatchTanques';
        console.log('🔍 firmar2daSeccion - Usando API para otros módulos');
    }
    
    console.log('🔍 firmar2daSeccion - URL del endpoint:', urlEndpoint);
    console.log('📤 firmar2daSeccion - Enviando datos al backend...');

    $.ajax({
        type: 'POST',
        url: urlEndpoint,
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
                console.log('🔍 firmar2daSeccion - Error response parsed:', errorResponse);
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
            try {
                // Intentar parsear como JSON
                let responseData = typeof response === 'string' ? JSON.parse(response) : response;
                
                if (responseData.result == 0) {
                    modulo == 4 ?
                        (modulos = 'pesaje y/o preparacion') :
                        (modulos = 'envasado y/o acondicionamiento');

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(`No es posible cerrar este proceso para el Batch ${idBatch}. Los módulos de ${modulos} aún no se encuentran completamente firmados`);
                    return false;
                }
            } catch (e) {
                console.log('❌ almacenarfirma - Error parseando respuesta:', e);
                console.log('🔍 almacenarfirma - Respuesta recibida:', response);
                
                // Si no es JSON válido, tratar como respuesta simple
                if (response == 0) {
                    modulo == 4 ?
                        (modulos = 'pesaje y/o preparacion') :
                        (modulos = 'envasado y/o acondicionamiento');

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(`No es posible cerrar este proceso para el Batch ${idBatch}. Los módulos de ${modulos} aún no se encuentran completamente firmados`);
                    return false;
                }
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
/**
 * MODIFICADO: Agregada función guardarCantidadAgua y corregido error de alertify
 * ANTES: Solo tenía función cargarControlProceso y error en alertify.info
 * AHORA: Incluye función para guardar cantidad de agua en batch_lote_materiales
 * Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
 * Motivo: Usuario requiere guardar automáticamente cantidad de agua utilizada
 */

// MODIFICADO: Función para cargar especificaciones del control de proceso desde la BD
    // ANTES: Esta función no se llamaba, por eso el "Control de proceso" aparecía vacío
    // AHORA: Se llama desde preparacioninfo.js para cargar las especificaciones
    // Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
    cargarControlProceso = () => {
        // MODIFICADO: Agregar logs para debuggear
        console.log('🔍 cargarControlProceso - Función iniciada');
        console.log('🔍 cargarControlProceso - Módulo:', modulo);
        console.log('🔍 cargarControlProceso - ID Batch:', idBatch);
        
        $.ajax({
            type: "POST",
            url: "../../html/php/controlProceso.php",
            data: { modulo, idBatch },

            success: function(response) {
                // MODIFICADO: Agregar logs para debuggear
                console.log('🔍 cargarControlProceso - Respuesta recibida:', response);
                console.log('🔍 cargarControlProceso - Tipo de respuesta:', typeof response);
                
                if (response == "" || response == 0) {
                    console.log('🔍 cargarControlProceso - No hay datos, retornando false');
                    return false;
                }

                let info = JSON.parse(response);
                console.log('🔍 cargarControlProceso - Datos parseados:', info);
                console.log('🔍 cargarControlProceso - Cantidad de registros:', info.length);
                
                let index = info.length;

                $(".color").val(info[index - 1].color);
                $(".olor").val(info[index - 1].olor);
                $(".apariencia").val(info[index - 1].apariencia);
                $(".ph").val(info[index - 1].ph);
                $("#in_viscocidad").val(info[index - 1].viscosidad);
                $("#in_densidad").val(info[index - 1].densidad);
                $(".untuosidad").val(info[index - 1].untuosidad);
                $(".espumoso").val(info[index - 1].espumoso);
                $("#in_grado_alcohol").val(info[index - 1].alcohol);
                
                console.log('✅ cargarControlProceso - Especificaciones cargadas exitosamente');
            },
            
            error: function(xhr, status, error) {
                // MODIFICADO: Agregar logs para debuggear errores
                console.error('❌ cargarControlProceso - Error en AJAX:');
                console.error('❌ cargarControlProceso - Status:', status);
                console.error('❌ cargarControlProceso - Error:', error);
                console.error('❌ cargarControlProceso - XHR:', xhr);
            }
        });
    }

    // NUEVO: Función para guardar la cantidad de agua en batch_lote_materiales
    // ANTES: No existía función para guardar el campo Agua
    // AHORA: Función que actualiza el campo lote donde ref_material=10003
    // Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
    guardarCantidadAgua = (cantidadAgua) => {
        console.log('🔍 guardarCantidadAgua - Función iniciada');
        console.log('🔍 guardarCantidadAgua - Cantidad de agua:', cantidadAgua);
        console.log('🔍 guardarCantidadAgua - ID Batch:', idBatch);
        
        if (!cantidadAgua || cantidadAgua <= 0) {
            console.log('🔍 guardarCantidadAgua - Cantidad inválida, no se guarda');
            return;
        }
        
        $.ajax({
            type: "POST",
            url: "../../html/php/guardarAgua.php",
            data: { 
                batch: idBatch,
                ref_material: 10003,
                cantidad_agua: cantidadAgua
            },
            success: function(response) {
                console.log('🔍 guardarCantidadAgua - Respuesta recibida:', response);
                console.log('🔍 guardarCantidadAgua - Tipo de respuesta:', typeof response);
                
                // MODIFICADO: jQuery ya parsea la respuesta automáticamente
                // ANTES: let result = JSON.parse(response); (causaba error)
                // AHORA: response ya es un objeto JavaScript
                // Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
                let result = response;
                
                if (result.success) {
                    console.log('✅ guardarCantidadAgua - Cantidad de agua guardada exitosamente');
                    // Opcional: Mostrar mensaje de éxito
                    alertify.success('Cantidad de agua guardada correctamente');
                } else {
                    console.log('🔍 guardarCantidadAgua - No se encontró material 10003 para este batch');
                    // MODIFICADO: Cambiar alertify.info por alertify.warning ya que info no existe
                    // ANTES: alertify.info('No se encontró registro de agua para este batch');
                    // AHORA: alertify.warning('No se encontró registro de agua para este batch');
                    // Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
                    alertify.warning('No se encontró registro de agua para este batch');
                }
            },
            error: function(xhr, status, error) {
                console.error('❌ guardarCantidadAgua - Error en AJAX:');
                console.error('❌ guardarCantidadAgua - Status:', status);
                console.error('❌ guardarCantidadAgua - Error:', error);
                console.error('❌ guardarCantidadAgua - XHR:', xhr);
                alertify.error('Error al guardar la cantidad de agua');
            }
        });
    }

    controlDataEspecificaciones = () => {
        let color = $('.color').val();
        let espumoso = $('.espumoso').val();
        let data = color * espumoso;
        return data;
    }

});
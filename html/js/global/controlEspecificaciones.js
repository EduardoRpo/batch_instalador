let controlProducto = [];

$(document).ready(function() {

    /* Valida que todos los datos del formulario de control sean cargados */

    cargarResultadosEspecificaciones = () => {
        /* Almacenar los datos del formulario en un array */

        $("#tblControlEspecificaciones tr").each(function() {
            let control = $(this).find("td:eq(2) select option:selected").val();

            if (control != undefined && control != "" && control != "0") {
                controlProducto.push(control);
            } else {
                let valor = $(this).find("td:eq(2) input").val();
                if (valor != undefined && valor != "") controlProducto.push(valor);
                else controlProducto = [];
            }
        });

        /* Validar que toda la informacion esta completa */

        modulo == 3 ? indice = 9 : modulo == 4 ? indice = 11 : indice = 9

        if (controlProducto.length < indice) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Ingrese todos los campos para el control del proceso");
            return 0;
        } else
            return 1;
    }

    /* Limpiar campos en el modulo de preparacion y aprobacion*/

    $(document).on("click", ".chkcontrol", function() {
        if ($(this).is(":checked")) {
            pasoEjecutado = 0;
            if (modulo == 3) reiniciarInstructivo();
            $(`.especificacion`).val("0");
            $(`.especificacionInput`).val("");
        }
    });

    /* Cargar tabla especificaciones */
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
                
                try {
                    let result = JSON.parse(response);
                    if (result.success) {
                        console.log('✅ guardarCantidadAgua - Cantidad de agua guardada exitosamente');
                        // Opcional: Mostrar mensaje de éxito
                        alertify.success('Cantidad de agua guardada correctamente');
                    } else {
                        console.log('🔍 guardarCantidadAgua - No se encontró material 10003 para este batch');
                        // Opcional: Mostrar mensaje informativo
                        alertify.info('No se encontró registro de agua para este batch');
                    }
                } catch (e) {
                    console.error('❌ guardarCantidadAgua - Error parseando respuesta:', e);
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
$(document).ready(function() {

    loadBatch = async() => {
        if (modulo != 9)
            await carguepreguntas(modulo);
        await cargarDesinfectantes();
        if (modulo == 9)
            cargarFisicoquimico();
        cargarBatch();
    }

    loadBatch()

    /* validar y Cargar informacion almacenada en el batch */

    cargarBatch = () => {
        $.ajax({
            type: "POST",
            url: "../../html/php/despeje.php",
            data: { operacion: 1, modulo, idBatch },

            success: function(response) {
                if (response == "") return false;

                let info = JSON.parse(response);

                /* Carga todas las preguntas y su respuesta almacenada */

                if (info !== "") {
                    for (let i = 0; i < info.length; i++) {
                        let question = "question-" + `${info[i].id_pregunta}`;
                        let valor = info[i].solucion;
                        $(`input:radio[name="${question}"][value="${valor}"]`).prop(
                            "checked",
                            true
                        );
                    }
                    cargarDesinfectante();
                } else return false;
            },
        });
    }

    /* Carga desinfectante y observaciones almacenadas en el batch */

    cargarDesinfectante = () => {
        console.log('🔍 cargarDesinfectante - Iniciando carga de desinfectante');
        console.log('🔍 cargarDesinfectante - Módulo:', modulo, 'ID Batch:', idBatch);
        
        $.ajax({
            type: "POST",
            url: "../../html/php/despeje.php",
            data: { operacion: 2, modulo, idBatch },

            success: function(response) {
                console.log('🔍 cargarDesinfectante - Respuesta recibida:', response);
                console.log('🔍 cargarDesinfectante - Tipo de respuesta:', typeof response);
                
                /* Carga observaciones, desinfectante y firma */
                try {
                    let info = JSON.parse(response);
                    console.log('🔍 cargarDesinfectante - JSON parseado exitosamente:', info);
                    
                    desinfectante = info.desinfectante;
                    observacion = info.observaciones;
                    firma = info.urlfirma;

                    $("#sel_producto_desinfeccion").val(desinfectante);
                    $("#in_observaciones").val(observacion);
                    firmado(firma, 1);

                    // Habilitar botón de pesaje inmediatamente después de cargar desinfectante
                    $(".pesaje_realizado").prop("disabled", false);

                    $.ajax({
                        type: "POST",
                        url: "../../html/php/despeje.php",
                        data: { operacion: 3, modulo, idBatch },

                        success: function(response) {
                            console.log('🔍 cargarDesinfectante - Respuesta segunda firma:', response);
                            
                            if (response == "") {
                                console.log('🔍 cargarDesinfectante - No hay segunda firma');
                                if (modulo == 3) {
                                    cargarEquipos();
                                    cargarControlProceso();
                                }

                                cargarfirma2daSeccion();
                                return false;
                            }

                            /* Carga segunda firma */
                            try {
                                let info = JSON.parse(response);
                                console.log('🔍 cargarDesinfectante - Segunda firma parseada:', info);
                                firma = info.urlfirma;
                                firmado(firma, 2);
                            } catch (e) {
                                console.log('❌ cargarDesinfectante - Error parseando segunda firma:', e);
                            }

                            cargarfirma2daSeccion();
                        },
                        error: function(xhr, status, error) {
                            console.log('❌ cargarDesinfectante - Error en segunda firma:', error);
                            console.log('🔍 cargarDesinfectante - XHR status:', xhr.status);
                            console.log('🔍 cargarDesinfectante - XHR responseText:', xhr.responseText);
                        }
                    });
                } catch (e) {
                    console.log('❌ cargarDesinfectante - Error parseando JSON:', e);
                    console.log('🔍 cargarDesinfectante - Respuesta que causó el error:', response);
                }
            },
            error: function(xhr, status, error) {
                console.log('❌ cargarDesinfectante - Error en petición AJAX:', error);
                console.log('🔍 cargarDesinfectante - XHR status:', xhr.status);
                console.log('🔍 cargarDesinfectante - XHR responseText:', xhr.responseText);
            }
        });
    }

    /* Cargar Tanques */

    cargarfirma2daSeccion = () => {
        if (modulo == 3) {
            cargarEquipos();
            cargarControlProceso();
        }
        /* obtener los tanques chequeados */

        $.ajax({
            type: "POST",
            url: "../../html/php/batch_tanques.php",
            data: { modulo, idBatch, operacion: 2 },

            success: function(response) {
                if (response == "\r\n1") {
                    T_tanques = 0;
                    T_tanquesOk = 0;
                } else {
                    var data = JSON.parse(response);
                    T_tanques = data[0].tanques;
                    T_tanquesOk = data[0].tanquesOk;

                    if (data == "") return false;

                    /* Chequea todos los tanques de acuerdo con la BD */

                    for (i = 1; i <= data[0].tanquesOk; i++) {
                        $(`#chkcontrolTanques${i}`).prop("checked", true);
                        $(`#chkcontrolTanques${i}`).prop("disabled", true);
                    }
                }
                /* Valida que todos los tanques esten chequeados para proceder a firmar */

                if (T_tanquesOk == T_tanques) {
                    $.ajax({
                        type: "POST",
                        url: "../../html/php/batch_tanques.php",
                        data: { operacion: 4, modulo, idBatch },

                        success: function(response) {
                            let data = JSON.parse(response);
                            if (data == 0) return false;
                            let firma = data.realizo;
                            let verifico = data.verifico;
                            firmado(firma, 3);
                            if (verifico !== undefined) firmado(verifico, 4);
                        },
                    });
                }
            },
        });
    }

    /* Registro de Firma */

    firmado = (datos, posicion) => {

        let template =
            '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
        let parent;

        btn_id = $("#idbtn").val();

        if (posicion == 1) {
            if (modulo == 9) {
                parent = $("#fisicoquimica_realizado").parent();
                $("#fisicoquimica_realizado").remove();
                $("#fisicoquimica_realizado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
                $(".fisicoquimica_verificado").prop("disabled", false);
            } else {
                parent = $("#despeje_realizado").parent();
                $("#despeje_realizado").remove();
                $("#despeje_realizado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
                $(".despeje_verificado").prop("disabled", false);
                $(".pesaje_realizado").prop("disabled", false);
                $(".preparacion_realizado").prop("disabled", false);
                $(".preparacion_verificado").prop("disabled", true);
                $("#controlpeso_realizado1").prop("disabled", false);
            }
        }

        if (posicion == 2) {
            if (modulo == 9) {
                parent = $("#fisicoquimica_verificado").parent();
                $("#fisicoquimica_verificado").remove();
                $("#fisicoquimica_verificado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
            } else {
                parent = $("#despeje_verificado").parent();
                $("#despeje_verificado").remove();
                $(".despeje_verificado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
            }
        }

        if (posicion == 3) {
            if (modulo == 2) {
                parent = $("#pesaje_realizado").parent();
                $("#pesaje_realizado").remove();
                $(".pesaje_realizado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
                $(".pesaje_verificado").prop("disabled", false);
            }
            if (modulo == 3) {
                parent = $("#preparacion_realizado").parent();
                $("#preparacion_realizado").remove();
                $(".preparacion_realizado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
                $(".preparacion_verificado").prop("disabled", false);
            }
            if (modulo == 9) {
                parent = $("#fisicoquimica_realizado").parent();
                $("#fisicoquimica_realizado").remove();
                $(".fisicoquimica_realizado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
                $(".fisicoquimica_verificado").prop("disabled", false);
            }
        }

        if (posicion == 4) {
            if (modulo == 2) {
                parent = $("#pesaje_verificado").parent();
                $("#pesaje_verificado").remove();
                $(".pesaje_verificado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
            }
            if (modulo == 3) {
                parent = $("#preparacion_verificado").parent();
                $("#preparacion_verificado").remove();
                $(".preparacion_verificado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
                $(".preparacion_verificado").prop("disabled", false);
            }
            if (modulo == 9) {
                parent = $("#fisicoquimica_verificado").parent();
                $("#fisicoquimica_verificado").remove();
                $(".fisicoquimica_verificado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
                $(".fisicoquimica_verificado").prop("disabled", false);
            }
        }

        let firma = template.replace(":firma:", datos);
        parent.append(firma).html;
    }
})
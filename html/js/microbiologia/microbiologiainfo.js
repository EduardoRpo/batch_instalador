/* Cargue tabla especificaciones */

let dataMicro = [];
modulo = 8;
$("#observacionesLote").slideUp();

$('.m2').hide();
$('.m3').hide();
$('.m4').hide();

$(document).ready(function() {
    $(".metodo").html("Siembra Total");
    $(`.microbiologia_verificado`).prop("disabled", true);

    $("#btnRechazado").change(function(e) {
        e.preventDefault();
        $("#observacionesLote").slideDown();
    });

    $("#btnAceptado").change(function(e) {
        e.preventDefault();
        $("#observacionesLote").slideUp();
    });
});

/* validar si existe multipresentacion */

$(document).ready(function() {

    cargar = (btn, Nobtn) => {
        let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
        confirm.set('onok', function(r) {
            sessionStorage.setItem("idbtn", Nobtn);
            sessionStorage.setItem("btn", btn.id);
            id = btn.id;

            if (id != 'microbiologia_verificado') {

                /* Validacion de equipos */
                let desinfectante = $("#sel_producto_desinfeccion").val();
                let desinfectante_observaciones = $("#desinfectante_obs").val();
                let sel_incubadora = $(".sel_incubadora").val();
                let sel_autoclave = $(".sel_autoclave").val();
                let sel_cabina = $(".sel_cabina").val();

                equipos = sel_incubadora * sel_autoclave * sel_cabina;

                if (desinfectante == "Seleccione") {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Seleccione el producto para desinfección");
                    return false;
                }

                if (equipos === 0) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Seleccione los Equipos");
                    return false;
                }

                let continuar = validarSeleccion();

                if (continuar != 0) {

                    let desinfectantes = {}
                    desinfectantes.desinfectante = desinfectante;
                    desinfectantes.observaciones = desinfectante_observaciones;
                    dataMicro.push(desinfectantes);

                    let equipos = {}
                    equipos.equipo1 = sel_incubadora;
                    equipos.equipo2 = sel_autoclave;
                    equipos.equipo3 = sel_cabina;
                    dataMicro.push(equipos);

                    for (let i = 0; i < cantMulti.length; i++) {
                        referencia = $(`#ref${i + 1}`).html();
                        let indice = referencia.indexOf("/");
                        referencia = referencia.substring(5, indice).trim()

                        if ($(`#inputMesofilos${i + 1}`).prop('disabled') == false) {
                            mesofilos = $(`#inputMesofilos${i + 1}`).val()

                            if (mesofilos) {
                                let dataMicrobiologia = {};
                                dataMicrobiologia.multi = i + 1
                                dataMicrobiologia.referencia = referencia
                                dataMicrobiologia.mesofilos = $(`#inputMesofilos${i + 1}`).val();
                                dataMicrobiologia.pseudomona = $(`#pseudomona${i + 1}`).val();
                                dataMicrobiologia.escherichia = $(`#escherichia${i + 1}`).val();
                                dataMicrobiologia.staphylococcus = $(`#staphylococcus${i + 1}`).val();;
                                dataMicrobiologia.fechaSiembra = $(`#fechaSiembra${i + 1}`).val();
                                dataMicrobiologia.fechaResultados = $(`#fechaResultados${i + 1}`).val();
                                dataMicro.push(dataMicrobiologia)
                            }
                        }
                    }

                    /* Validacion de campos */

                    if (dataMicro.length < 3) {
                        alertify.set("notifier", "position", "top-right");
                        alertify.error("Seleccione e Ingrese los datos del análisis Microbiológico");
                        dataMicro = []
                        return false
                    }

                    for (let i = 2; i < dataMicro.length; i++) {
                        if (!dataMicro[i].mesofilos || !dataMicro[i].pseudomona || !dataMicro[i].escherichia || !dataMicro[i].staphylococcus || !dataMicro[i].fechaSiembra || !dataMicro[i].fechaResultados) {
                            alertify.set("notifier", "position", "top-right");
                            alertify.error("Seleccione e Ingrese los datos del análisis Microbiológico");
                            dataMicro = []
                            return false
                        }
                    }

                }
            }

            /* Carga el modal para la autenticacion */

            $("#usuario").val("");
            $("#clave").val("");
            $("#m_firmar").modal("show");
        })
    };

    /* Almacenar info */

    guardar_microbiologia = (info) => {
        realizo = info.id;
        data = JSON.stringify(dataMicro)
        $.ajax({
            type: "POST",
            url: "../../html/php/microbiologia.php",
            data: { op: 2, dataMicro: data, modulo, idBatch, realizo },
            success: function(r) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Datos almacenados correctamente");

                if (r == 1) {
                    $(".microbiologia_realizado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
                    $(".microbiologia_verificado").prop("disabled", false);
                    firmar(info);
                }
                bloquearReferenciasGuardar(dataMicro)
            },
        });
    };

    /* Almacenar firma calidad */

    guardar_microbiologia_calidad = (info) => {
        verifico = info.id;
        $.ajax({
            type: "POST",
            url: "../../html/php/microbiologia.php",
            data: { op: 3, idBatch, verifico, modulo },
            success: function(r) {
                if (r == 'false') {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error(`No es posible cerrar este proceso para el Batch ${idBatch}. El módulo de fisicoqumico aún no se encuentran completamente firmado`);
                    return false
                }

                alertify.set("notifier", "position", "top-right");
                alertify.success("Datos almacenados correctamente");
                $(".microbiologia_verificado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);

                firmar(info);
            },
        });
    };

    multi()
});
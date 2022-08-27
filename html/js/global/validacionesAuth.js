var eq1
var eq2
var eq3
var id_multi

$(document).ready(function() {

    cargar = (btn, idbtn) => {

        let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

        confirm.set('onok', function(r) {
            sessionStorage.setItem('idbtn', idbtn)
            id = btn.id
            auth()
        });
    }

    //Validacion de control de tanques

    verificacionControlTanques = (id) => {

        array = ['pesaje_realizado', "preparacion_realizado", "aprobacion_realizado"]

        if (array.includes(id)) {
            validar = controlTanques()
            if (validar == 0) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('Seleccione el Tanque.')
                return false
            } else
                return true
        } else
            return true
    }

    // Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion

    verificacionDesinfeccion = () => {

        let seleccion = $('#sel_producto_desinfeccion').val()

        if (seleccion == 'Seleccione') {
            alertify.set('notifier', 'position', 'top-right')
            alertify.error('Seleccione el producto para desinfección.')
            return false
        } else
            return true
    }

    verificacionOrdenFirmas = (id) => {

        array = ['despeje_realizado', 'pesaje_realizado', "preparacion_realizado", "aprobacion_realizado", "aprobacion_verificado"]

        if (!array.includes(id)) {
            if (id !== 'despeje_verificado') {
                if ($('#despeje_verificado').is(':disabled') == false) {
                    alertify.set('notifier', 'position', 'top-right')
                    alertify.error('Inicialmente ejecute la firma para Calidad en la sección de Despeje de Lineas y Procesos.')
                    return false
                } else
                    return true
            } else
                return true
        } else
            return true
    }

    validarEquiposSeleccionados = (id) => {
        if (id == `controlpeso_realizado${id_multi}`) {

            if (modulo == 5) {
                eq1 = $(`#sel_envasadora${id_multi}`).val();
                eq2 = $(`#sel_loteadora${id_multi}`).val();
                eq = eq1 * eq2
            } else if (modulo == 6) {
                eq1 = $(`#sel_banda${id_multi}`).val();
                eq2 = $(`#sel_etiquetadora${id_multi}`).val();
                eq3 = $(`#sel_tunel${id_multi}`).val();
                eq = eq1 * eq2 * eq3
            } else if (modulo == 8) {
                eq1 = $(`#sel_incubadora`).val();
                eq2 = $(`#sel_autoclave`).val();
                eq3 = $(`#sel_cabina`).val();
                eq = eq1 * eq2 * eq3
            }

            if (!eq) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Seleccione los equipos a usar.");
                return false;
            } else
                return true

        } else
            return false
    }

    obtenerMuestras = () => {
        if (id == `controlpeso_realizado${id_multi}`) {
            i = sessionStorage.getItem(`totalmuestras${id_multi}`);

            modulo == 5 ?
                cantidad_muestras = $(`#muestras${id_multi}`).val() :
                cantidad_muestras = $(`#muestras${id_multi}`).val() * 5;

            if (i != cantidad_muestras) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todas las muestras");
                return false;
            } else
                return true
        }
    }

    validarControlPeso = async(id) => {
        if (typeof id_multi !== "undefined") {
            result = await validarEquiposSeleccionados(id)
            if (result) {
                crearEquipos()
                if (modulo == 5)
                    result = await validarLote()
                else
                    result = true
                if (result) {
                    return result = obtenerMuestras()
                } else return false
            } else
                return false
        }
    }

    /* Carga el modal para la autenticacion */

    auth = async() => {

        if (modulo == 2 || modulo == 3 || modulo == 4) {
            result = await verificacionControlTanques(id)
            if (!result) return false
        } else
            result = true

        if (result) {
            result = await verificacionDesinfeccion()
            if (!result) return false
        }

        if (modulo == 2 || modulo == 3 || modulo == 4 && result) {
            result = await verificacionOrdenFirmas(id)
            if (!result) return false
        }

        if (modulo == 2 && result) {
            result = await verificacionCargaLotes(id)
            if (!result) return false
        }

        if (modulo == 3 && result) {
            result = await validacionInstructivo(id)
            if (!result) return false
        }

        if (modulo == 3 || modulo == 4 && result) {
            result = await validacionEspecificaciones(id)
            if (!result) return false
        }

        if (modulo == 4 && result && id == `aprobacion_verificado`) {
            result = await validarCierreProcesos2y3()
            if (!result) return false
        }

        if (modulo == 5 && result && id == `controlpeso_realizado${id_multi}` || modulo == 6 && result && id == `controlpeso_realizado${id_multi}`) {
            result = await validarControlPeso(id)
            if (!result) return false
        }

        if (modulo == 5 && result && id == `devolucion_realizado${id_multi}`) {
            result = await validarDevolucionMaterialEnvasado(id)
            if (!result) return false
        }

        if (modulo == 6 && result && id == `devolucion_realizado${id_multi}`) {
            result = await validarDevolucionMaterialAcondicionamiento(id)
            if (!result) return false
        }

        if (modulo == 6 && result && id == `conciliacion_realizado${id_multi}`) {
            result = await validarDataConciliacion()
            if (!result) return false
        }

        if (modulo == 6 && result && id == `conciliacion_realizado${id_multi}`) {
            result = await validarTipoEntrega()
            if (!result) return false
        }

        if (modulo == 7 && result) {
            result = await validarData()
            if (!result) return false
        }

        if (modulo == 8 && result) {
            result = await validarData()
            if (!result) return false
        }

        if (modulo == 10 && result) {
            result = await validacionesCheckLiberacion()
            if (result)
                result = await validarDataDespachos()
            if (!result) return false
        }

        if (result) {
            $('#usuario').val('')
            $('#clave').val('')
            $('#m_firmar').modal('show')
        }
    }

});